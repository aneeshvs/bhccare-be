<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingRequest;
use App\OnboardingService\InitialEnquiryService;
use App\OnboardingService\FundingDetailService;
use App\OnboardingService\EmergencyContactService;
use App\OnboardingService\ScheduleOfCareService;
use App\OnboardingService\CulturalBackgroundService;
use App\OnboardingService\NdisGoalServices;
use App\OnboardingService\HealthProfessionalDetailService;
use App\OnboardingService\DiagnosisSummaryService;
use App\OnboardingService\HealthInformationService;
use App\OnboardingService\HealthcareSupportDetailService;
use App\OnboardingService\BehaviourSupportService;
use App\OnboardingService\MedicalAlertService;
use App\OnboardingService\PreventiveHealthSummaryService;
use App\OnboardingService\SupportInformationService;
use App\OnboardingService\FormCompletionService;
use App\Models\InitialEnquiry;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends UniversalController
{
    public function update(
        StoreOnboardingRequest  $request,
        InitialEnquiryService $initialService,
        FundingDetailService $fundingDetailService,
        EmergencyContactService $emergencyContactService,
        ScheduleOfCareService   $scheduleOfCareService,
        CulturalBackgroundService $culturalBackgroundService,
        NdisGoalServices $ndisGoalService,
        HealthProfessionalDetailService $healthProfessionalDetailService,
        DiagnosisSummaryService $diagnosisSummaryService,
        HealthInformationService $healthInformationService,
        HealthcareSupportDetailService $healthcareSupportDetailService,
        BehaviourSupportService $behaviourSupportService,
        MedicalAlertService $medicalAlertService,
        PreventiveHealthSummaryService $preventiveHealthSummaryService,
        SupportInformationService $supportInformationService,
        FormCompletionService $completionService // ✅ inject it
    ) {
        $data = $request->validated();
        //form completion
         $isFinal = $request->boolean('submit_final');
         $data['form_status'] = $isFinal ? 'completed' : 'in_progress';


        $result = DB::transaction(function () use (
            $data,
            $initialService,
            $fundingDetailService,
            $emergencyContactService,
            $scheduleOfCareService,
            $culturalBackgroundService,
            $ndisGoalService,
            $healthProfessionalDetailService,
            $diagnosisSummaryService,
            $healthInformationService,
            $healthcareSupportDetailService,
            $behaviourSupportService,
            $medicalAlertService,
            $preventiveHealthSummaryService,
            $supportInformationService,
            $completionService,
        ) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            $initial = $initialService->save($data);
            $data['initial_enquiry_id'] = $initial->id;

            $funding = $fundingDetailService->save($data);
            $contacts = $emergencyContactService->save($data);
            $schedules = $scheduleOfCareService->saveMany($data['schedule_of_cares'] ?? [], $initial->id);
            $cultural = $culturalBackgroundService->save($data);
            $ndisGoals = $ndisGoalService->saveMany($data['ndis_goals_onboarding'] ?? [], $initial->id);
            $healthProfessionals = $healthProfessionalDetailService->saveMany($data['health_professional_details'] ?? [], $initial->id);
            $diagnosis = $diagnosisSummaryService->save($data);
            $healthInfo = $healthInformationService->save($data);
            $healthcare = $healthcareSupportDetailService->save($data);
            $behaviourSupport = $behaviourSupportService->save($data);
            $medicalAlert = $medicalAlertService->save($data);
            $preventiveHealth = $preventiveHealthSummaryService->save($data);
            $supportInformation = $supportInformationService->save($data);

            // ✅ Calculate completion
            $completion = $completionService->calculate($initial);
            $initial['completion_percentage'] =$completion;



           if ($data['form_status'] === 'completed') {

                $initial->form_status = 'completed';

                // api call to core php
                Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
                    'uuid' => (string) $initial->uuid,
                    'form_name' => 'onboarding',
                    'completion_percentage' => $completion,
                    'form_status' => 'completed',
                ]);
            } else {
                Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
                    'uuid' => (string) $initial->uuid,
                    'form_name' => 'onboarding',
                    'completion_percentage' => $completion,
                    'form_status' => 'in_progress',
                ]);


            }


            return compact(
                'initial', 'funding', 'contacts', 'schedules',
                'cultural', 'ndisGoals', 'healthProfessionals', 'diagnosis',
                'healthInfo', 'healthcare', 'behaviourSupport', 'medicalAlert',
                'preventiveHealth', 'supportInformation', 'completion'
            );
        });

        return response()->json([
            'success' => true, // ✅ this is expected by frontend
            'status' => 200,
            'message' => 'Form submitted.',
            'data' => $result,
        ]);

    }





    // show deatils

     public function show(string $uuid, FormCompletionService $completionService)
        {
            $initial = InitialEnquiry::with([
                'funding', 'emergencyContact', 'scheduleOfCares', 'culturalBackground',
                'ndisGoals', 'healthProfessionalDetails', 'diagnosisSummary',
                'healthInformation', 'healthcareSupportDetail', 'behaviourSupport',
                'medicalAlert', 'preventiveHealthSummary', 'supportInformation', 'staff'
            ])->where('uuid', $uuid)->firstOrFail();



            $completion = $completionService->calculate($initial);
            $initial['completion_percentage'] =$completion;
            return response()->json([
                'status' => true,
                'message' => 'Client details fetched successfully.',
                'data' => $initial,

            ]);
        }

    //get uuid
     public function getUuid(Request $request)
    {
        $userid = $request->query('userid');
        $clientType = $request->query('client_type');

        $initial = InitialEnquiry::where('user_id', $userid)
            ->where('client_type', $clientType)
            ->latest()
            ->first();

        if ($initial) {
            return response()->json(['uuid' => (string) $initial->uuid]);
        }

        return response()->json(['uuid' => null], 404);
    }

    // export pdf
        public function exportFullFormPdf(string $uuid)
        {
            $initial = InitialEnquiry::with([
                'funding', 'emergencyContact', 'scheduleOfCares', 'culturalBackground',
                'ndisGoals', 'healthProfessionalDetails', 'diagnosisSummary',
                'healthInformation', 'healthcareSupportDetail', 'behaviourSupport',
                'medicalAlert', 'preventiveHealthSummary', 'supportInformation', 'staff'
            ])->where('uuid', $uuid)->firstOrFail();


            $pdf = Pdf::loadView('pdf.onboarding_full_form', compact('initial'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('Onboarding_Form_' . $initial->full_name . '.pdf');
    }

     // remove specific data

        public function removeSection(Request $request)
    {
        $uuid = $request->input('uuid');
        $table = $request->input('table'); // e.g. 'schedule_of_care'
        $field = $request->input('field'); // e.g. 'type_of_service'
        $value = $request->input('value'); // e.g. 'Community Access'

        if (!$uuid || !$table || !$field || !$value) {
            return response()->json([
                'status' => false,
                'message' => 'uuid, table, field, and value are required.',
            ], 400);
        }

        $initial = InitialEnquiry::where('uuid', $uuid)->first();
        if (!$initial) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid UUID.',
            ], 404);
        }

        // ✅ Map table name to Model
        $modelMap = [
            'schedule_of_care' => \App\Models\ScheduleOfCare::class,
            'ndis_goals' => \App\Models\NdisGoals::class,
            'health_professional_detail' => \App\Models\HealthProfessionalDetail::class,
            // Add other tables here
        ];

        if (!array_key_exists($table, $modelMap)) {
            return response()->json([
                'status' => false,
                'message' => 'Unsupported table.',
            ], 400);
        }

        $modelClass = $modelMap[$table];

        $record = $modelClass::where('initial_enquiry_id', $initial->id)
            ->where($field, $value)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.',
            ], 404);
        }

        $original = $record->getOriginal(); // log before delete
        $record->delete();

        activity()
            ->useLog($table)
            ->performedOn($record)
            ->causedBy(Auth::user())
            ->withProperties([
                'attributes' => [$field => $value],
                'old' => $original,
                'initial_enquiry_id' => $initial->id,
                'uuid' => $uuid,
                'client_type' => $initial->client_type,
                'staff_id' => $initial->staff_id,
                'user_id' => $initial->user_id,
            ])
            ->log(ucwords(str_replace('_', ' ', $table)) . ' entry deleted');

        return response()->json([
            'status' => true,
            'message' => 'Entry removed successfully.',
        ]);
    }


}













