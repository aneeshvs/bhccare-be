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


use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    FormCompletionService $completionService
) {
    $data = $request->validated();

    // ✅ Determine form status
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
        $completionService
    ) {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $staff = \App\Models\Staff::where('user_id', $user->id)->first();
        $data['staff_id'] = $staff?->id ?? null;

        // ✅ Save all sections
        $initial = $initialService->save($data);
        $data['initial_enquiry_id'] = $initial->id;

        $fundingDetailService->save($data);
        $emergencyContactService->save($data);
        $scheduleOfCareService->saveMany($data['schedule_of_cares'] ?? [], $initial->id);
        $culturalBackgroundService->save($data);
        $ndisGoalService->saveMany($data['ndis_goals_onboarding'] ?? [], $initial->id);
        $healthProfessionalDetailService->saveMany($data['health_professional_details'] ?? [], $initial->id);
        $diagnosisSummaryService->save($data);
        $healthInformationService->save($data);
        $healthcareSupportDetailService->save($data);
        $behaviourSupportService->save($data);
        $medicalAlertService->save($data);
        $preventiveHealthSummaryService->save($data);
        $supportInformationService->save($data);

        // ✅ Calculate completion
        $completion = $completionService->calculate($initial);
        $initial['completion_percentage'] = $completion;

        // ✅ Update Core PHP system form status
        try {
            $response = Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                'uuid' => (string) $initial->uuid,
                'form_name' => 'onboarding',
                'completion_percentage' => $completion,
                'form_status' => $data['form_status'] === 'completed' ? 'completed' : 'in_progress',
            ]);

            if ($response->failed()) {
                Log::warning('⚠️ Core PHP update-form-status failed', [
                    'uuid' => $initial->uuid,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('❌ Error calling Core PHP update-form-status: ' . $e->getMessage());
        }

        return $initial;
    });

    // ✅ After transaction — handle PDF generation for completed form
    if ($data['form_status'] === 'completed') {
        try {



            // Generate PDF
            $pdf = Pdf::loadView('pdf.onboarding_full_form', [
                'initial' => $result->load([
                    'funding', 'emergencyContact', 'scheduleOfCares', 'culturalBackground',
                    'ndisGoals', 'healthProfessionalDetails', 'diagnosisSummary',
                    'healthInformation', 'healthcareSupportDetail', 'behaviourSupport',
                    'medicalAlert', 'preventiveHealthSummary', 'supportInformation', 'staff'
                ])
            ])->setPaper('A4', 'portrait');

            $fileName = 'Onboarding_Form_' . $result->full_name . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ✅ Send PDF to Core PHP user_documents
            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';
                   $staffEmail = $result->staff?->email ?? null;


                $response = Http::attach(
                    'doc',
                    file_get_contents($filePath),
                    $fileName
                )->asMultipart()->post($corePhpUrl, [
                    'userid'    => $result->user_id,
                    'title'     => 'Onboarding Form',
                    'comments'  => 'Form completed successfully.',
                    'companyid' => $result->company_id ?? 1,
                    'staff_email' => $staffEmail,
                ]);

            if ($response->successful()) {
                Log::info('✅ Form PDF synced to Core PHP user_documents', [
                    'userid' => $result->user_id,
                    'form'   => 'Onboarding',
                    'response' => $response->body(),
                ]);
            } else {
                Log::warning('⚠️ Failed to sync PDF to user_documents', [
                    'userid' => $result->user_id,
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }

            // Cleanup
            @unlink($filePath);

        } catch (\Exception $e) {
            Log::error('❌ Error exporting or sending PDF: ' . $e->getMessage());
        }
    }




    return response()->json([
        'success' => true,
        'status' => 200,
        'message' => 'Form submitted successfully.',
        'data' => [
        'initial' => $result
    ],
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

    //renew pdf



public function renewPdf(Request $request, $uuid)
{
    $request->validate([
        'staff_password' => 'required|string',
        'email' => 'required|email|exists:users,email', // staff email passed from frontend
    ]);

    $initial = InitialEnquiry::with([
                'funding', 'emergencyContact', 'scheduleOfCares', 'culturalBackground',
                'ndisGoals', 'healthProfessionalDetails', 'diagnosisSummary',
                'healthInformation', 'healthcareSupportDetail', 'behaviourSupport',
                'medicalAlert', 'preventiveHealthSummary', 'supportInformation', 'staff'
            ])->where('uuid', $uuid)->firstOrFail();

    // 2. Get staff user from users table
    $user = User::where('email', $request->email)->firstOrFail();

    // 3. Verify staff password
    if (!Hash::check($request->staff_password, $user->password)) {
        return response()->json(['error' => 'Invalid staff password'], 403);
    }

    // 4. Generate new PDF (without password in the file)
   $pdf = Pdf::loadView('pdf.onboarding_full_form', compact('initial'));

    $fileName = 'renewed_'.$uuid.'_'.time().'.pdf';
    $filePath = storage_path('app/renewed-pdfs/'.$fileName);

    if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0755, true);
    }

    $pdf->save($filePath);

    // 5. Return file download
    return response()->download($filePath, $fileName);
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













