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
        SupportInformationService $supportInformationService

        ) {
        $data = $request->validated();


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
                $ndisGoalService = $ndisGoalService->saveMany($data['ndis_goals_onboarding'] ?? [], $initial->id);
                $healthProfessionals = $healthProfessionalDetailService->saveMany($data['health_professional_details'] ?? [],$initial->id);
                $diagnosis = $diagnosisSummaryService->save($data);
                $healthInfo = $healthInformationService->save($data);
                $healthcare = $healthcareSupportDetailService->save($data);
                $behaviourSupport = $behaviourSupportService->save($data);
                $medicalAlert = $medicalAlertService->save($data);
                $preventiveHealth = $preventiveHealthSummaryService->save($data);
                $supportInformation = $supportInformationService->save($data);

                $initial->form_status = 'completed';
                $initial->save();

                Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
                    'uuid' => (string) $initial->uuid, // 🔁 cast to string
                    'form_name' => 'onboarding',
                    'form_status' => 'completed',
                ]);
                //activity Log
                activity()
                ->causedBy(Auth::user()) // the staff doing the action
                ->withProperties([
                    'staff_id'     => $staff?->id,
                    'user_id'      => $data['user_id'] ?? null,
                    'client_type'  => $data['client_type'] ?? null,
                    'uuid'         => $initial->uuid ?? null,
                ])
                ->log('Onboarding form updated.');

               return compact('initial', 'funding','contacts','schedules',
                'cultural','ndisGoalService','healthProfessionals','diagnosis',
                'healthInfo','healthcare','behaviourSupport','medicalAlert', 'preventiveHealth','supportInformation'); // ✅ returns both models
        });


        return response()->json([
            'status' => true,
            'message' => 'Form submitted and client created successfully.',
            'data' => $result, // ✅ will now return the inserted row
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

            return response()->json([
                'status' => true,
                'message' => 'Client details fetched successfully.',
                'data' => $initial,
                'completion_percentage' => $completion
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
    }













