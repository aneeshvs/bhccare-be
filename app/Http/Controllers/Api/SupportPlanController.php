<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Requests\StoreSupportPlanRequest;
use App\SupportplanService\SupportPlanService;
use App\SupportplanService\SupportPlanCompletionService;
use App\SupportplanService\SupportPlanApprovalService;
use App\SupportplanService\SupportPlanRepresentativeService;
use App\SupportplanService\SupportPlanCarePartnerService;
use App\SupportplanService\KeepingInTouchService;
use App\SupportplanService\NonResponseVisitPlanService;
use App\SupportplanService\ParticipantDetailService;
use App\SupportplanService\SupportPlanContactDetailService;
use App\SupportplanService\SupportPlanContactDetailSecondaryService;
use App\SupportplanService\SupportPlanFundingService;
use App\SupportplanService\EmployeeMatchingNeedService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\SupportPlan;
use App\Models\SupportPlanBehaviourSupport;
use App\Models\SupportPlanCarePartner;
use App\Models\SupportPlanContactDetailSecondary;
use App\Models\SupportPlanContinence;
use App\Models\SupportPlanMobilityTransfer;
use App\SupportplanService\CulturalDiversityService;
use App\SupportplanService\SupportPlanFallsRiskService;
use App\SupportplanService\SupportPlanGeneralHealthService;
use App\SupportplanService\SupportPlanLivingArrangementService;
use App\SupportplanService\SupportPlanMedicationManagementService;
use App\SupportplanService\SupportPlanMyGoalService;
use App\SupportplanService\SupportPlanServiceService;
use App\SupportplanService\SupportPlanMobilityTransferService;
use App\SupportplanService\SupportPlanCognitionService;
use App\SupportplanService\SupportPlanBehaviourSupportService;
use App\SupportplanService\SupportPlanPersonalCareService;
use App\SupportplanService\SupportPlanContinenceService;
use App\SupportplanService\SupportPlanDietaryService;
use App\SupportplanService\SupportPlanEmergencyReadinessService;
use App\SupportplanService\SupportPlanEndOfLifeAdvancedCarePlanningService;
use App\SupportplanService\SupportPlanVisionService;
use App\SupportplanService\SupportPlanHearingService;
use App\SupportplanService\SupportPlanPainManagementService;
use App\SupportplanService\SupportPlanSkinConditionService;
use App\SupportplanService\SupportPlanSocialConnectionService;

use App\SupportplanService\SupportPlanHomeMaintenanceService;
use App\SupportplanService\SupportPlanFinancialSupportService;
use App\SupportplanService\SupportPlanFireHeatReadinessService;
use App\SupportplanService\SupportPlanInformalSupportService;
use App\SupportplanService\SupportPlanPowerOutageService;
use App\SupportplanService\SupportPlanStormFloodingService;
use App\SupportplanService\SupportPlanTelecommunicationOutageService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;



class SupportPlanController extends UniversalController
{

public function update(StoreSupportPlanRequest $request,
SupportPlanService $service,
SupportPlanApprovalService $approvalService,
SupportPlanCompletionService $completionService,
SupportPlanRepresentativeService $representativeService,
SupportPlanCarePartnerService $carePartnerService,
KeepingInTouchService $keepingInTouchService,
NonResponseVisitPlanService $nonResponseVisitPlanService,
ParticipantDetailService $participantDetailService,
SupportPlanContactDetailService $ContactDetailService,
SupportPlanContactDetailSecondaryService $ContactDetailServiceSecondry,
SupportPlanFundingService $supportPlanFundingService,
SupportPlanServiceService $supportPlanServiceService,
EmployeeMatchingNeedService $employeeMatchingNeedService,
SupportPlanMyGoalService $supportPlanMyGoalService,
SupportPlanLivingArrangementService $supportPlanLivingArrangement,
CulturalDiversityService $cultural_diversity_service,
SupportPlanGeneralHealthService $supportPlanGeneralHealthService,
SupportPlanMedicationManagementService $supportPlanMedicationManagementService,
SupportPlanMobilityTransferService $supportPlanMobilityService,
SupportPlanFallsRiskService $supportPlanFallsService,
SupportPlanCognitionService $supportplanCognitionService,
SupportPlanBehaviourSupportService $supportplanbehaviourService,
SupportPlanPersonalCareService $supportPlanPersonCareService,
SupportPlanContinenceService $supportPlanContinenceService,
SupportPlanVisionService $supportPlanVisionService,
SupportPlanHearingService $supportPlanHearingService,
SupportPlanSkinConditionService $supportPlanSkinConditionService,
SupportPlanDietaryService   $supportPlanDietaryService,
SupportPlanPainManagementService  $supportPlanPainManagementService,
SupportPlanSocialConnectionService $supportPlanSocialConnectionService,
SupportPlanHomeMaintenanceService  $supportPlanHomeMaintenanceService,
SupportPlanFinancialSupportService $supportPlanFinancialSupportService,
SupportPlanInformalSupportService $supportPlanInformalSupportService,
SupportPlanEmergencyReadinessService $supportPlanEmergencyReadinessService,
SupportPlanFireHeatReadinessService $SupportPlanFireHeatReadinessService,
SupportPlanStormFloodingService  $supportPlanStormFloodingService ,
SupportPlanTelecommunicationOutageService $SupportPlanTelecommunicationOutageService,
SupportPlanPowerOutageService  $supportPlanPowerOutageService,
SupportPlanEndOfLifeAdvancedCarePlanningService $supportPlanEndOfLifeAdvancedCarePlanningService


)

{
    $data = $request->validated();

    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';



    $result=DB::transaction(function () use ($data, $service,
     $completionService,
     $approvalService,
     $representativeService,
     $carePartnerService,
     $keepingInTouchService,
     $nonResponseVisitPlanService,
     $participantDetailService,
     $ContactDetailService,
     $ContactDetailServiceSecondry,
     $supportPlanFundingService,
     $supportPlanServiceService,
     $employeeMatchingNeedService,
     $supportPlanMyGoalService,
     $supportPlanLivingArrangement,
     $cultural_diversity_service,
     $supportPlanGeneralHealthService,
     $supportPlanMedicationManagementService,
     $supportPlanMobilityService,
     $supportPlanFallsService,
     $supportplanCognitionService,
     $supportplanbehaviourService,
     $supportPlanPersonCareService,
     $supportPlanContinenceService,
     $supportPlanVisionService,
     $supportPlanHearingService,
     $supportPlanSkinConditionService,
     $supportPlanDietaryService,
     $supportPlanPainManagementService,
     $supportPlanSocialConnectionService,
     $supportPlanHomeMaintenanceService,
     $supportPlanFinancialSupportService,
     $supportPlanInformalSupportService,
     $supportPlanEmergencyReadinessService,
     $SupportPlanFireHeatReadinessService,
     $supportPlanStormFloodingService ,
     $SupportPlanTelecommunicationOutageService,
     $supportPlanPowerOutageService,
     $supportPlanEndOfLifeAdvancedCarePlanningService,






     ) {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $staff = \App\Models\Staff::where('user_id', $user->id)->first();
        $data['staff_id'] = $staff?->id ?? null;

        $supportPlan = $service->save($data);

         $data['support_plan_id'] = $supportPlan->id;

         $approval = $approvalService->save($data);
         $representative = $representativeService->save($data);
         $carePartner = $carePartnerService->save($data);
         $keepingInTouchService->save($data);
         $nonResponseVisitPlanService->save($data);
         $participantDetailService->save($data);
         $ContactDetailService->save($data);
         $ContactDetailServiceSecondry->save($data);
         $supportPlanFundingService->save($data);
         $supportPlanServiceService->saveMany($data['support_plan_services'] ?? [], $supportPlan->id);
         $employeeMatchingNeedService->save($data);
         $supportPlanMyGoalService->saveMany($data['support_plan_my_goals'] ?? [],$supportPlan->id);
         $supportPlanLivingArrangement->save($data);
         $cultural_diversity_service->save($data);
         $supportPlanGeneralHealthService->save($data);
         $supportPlanMedicationManagementService->save($data);
         $supportPlanMobilityService->save($data);
         $supportPlanFallsService->save($data);
         $supportplanCognitionService->save($data);
         $supportplanbehaviourService->save($data);
         $supportPlanPersonCareService->save($data);
         $supportPlanContinenceService->save($data);
         $supportPlanVisionService->save($data);
         $supportPlanHearingService->save($data);
         $supportPlanSkinConditionService->save($data);
         $supportPlanDietaryService->save($data);
         $supportPlanPainManagementService->save($data);
         $supportPlanSocialConnectionService->save($data);
         $supportPlanHomeMaintenanceService->save($data);
         $supportPlanFinancialSupportService->save($data);
         $supportPlanInformalSupportService->save($data);
         $supportPlanEmergencyReadinessService->save($data);
         $SupportPlanFireHeatReadinessService->save($data);
         $supportPlanStormFloodingService->save($data);
         $SupportPlanTelecommunicationOutageService->save($data);
         $supportPlanPowerOutageService->save($data);
         $supportPlanEndOfLifeAdvancedCarePlanningService->save($data);




// ✅ New Completion Logic
        $completion = $completionService->calculate($supportPlan);
        $supportPlan->completion_percentage = $completion;

        // ✅ Report status
        $formStatus = $data['form_status'] ?? 'in_progress';

        try {
            Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                'uuid' => (string) $supportPlan->uuid,
                'form_name' => 'support_plan',
                'completion_percentage' => $completion,
                'form_status' => $formStatus,
            ]);
        } catch (\Exception $e) {
            Log::error('Error reporting support plan form status: ' . $e->getMessage());
        }

        if ($formStatus === 'completed') {
            $supportPlan->form_status = 'completed';
            $supportPlan->save();
        }

       return [
        'supportPlan' => $supportPlan->load([
            'approval',
            'representativeApproval',
            'careApproval',
            'keep_in_touch',
            'non_responsive',
            'participantDetail',
            'contactDetail',
            'contactDetailSecondary',
            'SupportFunding',
            'services',
            'supportplan_employee',
            'myGoals',
            'LivingArrangement',
            'cultural_diversity',
            'general_health',
            'medication_management',
            'mobility_transfer',
            'fallsRisk',
            'cognition',
            'behaviourSupport',
            'personalCare',
            'continence',
            'vision',
            'hearing',
            'skinCondition',
            'dietary',
            'painManagement',
            'socialConnection',
            'homeMaintenance',
            'financialSupport',
            'informalSupport',
            'emergencyReadiness',
            'fireHeatReadiness',
            'stormFlooding',
            'telecommunicationOutage',
            'powerOutage',
            'endOfLifeAdvancedCarePlanning',

        ])
    ];





    });

      /**
 * ----------------------------------------------------------
 * 📌 AFTER TRANSACTION → PDF GENERATION + USER DOCUMENT API
 * ----------------------------------------------------------
 */
if ($data['form_status'] === 'completed') {

    try {
        // ⭐ Generate PDF
        $pdf = Pdf::loadView('pdf.supportplan', [
            'supportPlan' => $result['supportPlan']->load([
                'approval',
                'representativeApproval',
                'careApproval',
                'keep_in_touch',
                'non_responsive',
                'participantDetail',
                'contactDetail',
                'contactDetailSecondary',
                'SupportFunding',
                'services',
                'supportplan_employee',
                'myGoals',
                'LivingArrangement',
                'cultural_diversity',
                'general_health',
                'medication_management',
                'mobility_transfer',
                'fallsRisk',
                'cognition',
                'behaviourSupport',
                'personalCare',
                'continence',
                'vision',
                'hearing',
                'skinCondition',
                'dietary',
                'painManagement',
                'socialConnection',
                'homeMaintenance',
                'financialSupport',
                'informalSupport',
                'emergencyReadiness',
                'fireHeatReadiness',
                'stormFlooding',
                'telecommunicationOutage',
                'powerOutage',
                'endOfLifeAdvancedCarePlanning',
            ])
        ])->setPaper('A4', 'portrait');

        $fileName = 'Support_Plan_' . ($result['supportPlan']->full_name ?? 'Record') . '.pdf';
        $filePath = storage_path("app/temp/{$fileName}");
        $pdf->save($filePath);


        // ⭐ Upload PDF → Core PHP Document API
        $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';

        $result['supportPlan']->load('staff');
        $staffEmail = $result['supportPlan']->staff?->email ?? null;


        $response = Http::attach(
            'doc',
            file_get_contents($filePath),
            $fileName
        )->asMultipart()->post($corePhpUrl, [
            'userid'    => $result['supportPlan']->user_id,
            'title'     => 'Support Plan',
            'comments'  => 'Support Plan completed successfully.',
            'companyid' => $result['supportPlan']->company_id ?? 1,
             'staff_email' => $staffEmail,
        ]);

        if (!$response->successful()) {
            Log::warning("⚠ Failed to upload Support Plan PDF", [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        }

        // ⭐ Delete temp file
        @unlink($filePath);

    } catch (\Exception $e) {
        Log::error("❌ Support Plan PDF/upload failed: " . $e->getMessage());
    }
}

        return response()->json([
            'success' => true, // ✅ this is expected by frontend
            'status' => 200,
            'message' => 'Support Plan saved successfully.',
            'data' => $result,
        ]);

}



public function showByUuid($uuid,SupportPlanCompletionService $completionService,)
{
    $supportPlan = SupportPlan::with(['approval','representativeApproval','careApproval',
    'keep_in_touch','non_responsive','participantDetail','contactDetail',
    'contactDetailSecondary','SupportFunding','services',
    'supportplan_employee','myGoals','LivingArrangement',
    'cultural_diversity','general_health',
    'medication_management','mobility_transfer','fallsRisk',
    'cognition','behaviourSupport','personalCare',
    'continence','vision','hearing','skinCondition',
    'dietary','painManagement','socialConnection','homeMaintenance',
    'financialSupport','informalSupport','emergencyReadiness',
    'fireHeatReadiness','stormFlooding','telecommunicationOutage',
    'powerOutage','endOfLifeAdvancedCarePlanning'])->where('uuid', $uuid)->firstOrFail();

    if (!$supportPlan) {
        return response()->json(['success' => false, 'message' => 'Support Plan not found'], 404);
    }
    // ✅ New Completion Logic
        $completion = $completionService->calculate($supportPlan);
        $supportPlan->completion_percentage = $completion;


    return response()->json([
        'success' => true,
        'data' => $supportPlan,
    ]);
}


public function exportFullFormPdf(string $uuid)
{
    $supportPlan = SupportPlan::with(['staff','approval','representativeApproval','careApproval',
    'keep_in_touch','non_responsive','participantDetail','contactDetail',
    'contactDetailSecondary','SupportFunding','services',
    'supportplan_employee','myGoals',
    'LivingArrangement','cultural_diversity','general_health',
    'medication_management','mobility_transfer',
    'fallsRisk','cognition','behaviourSupport',
    'personalCare','continence','vision','hearing','skinCondition','dietary',
    'painManagement','socialConnection','homeMaintenance',
    'financialSupport','informalSupport','emergencyReadiness','fireHeatReadiness',
    'stormFlooding','telecommunicationOutage','powerOutage','endOfLifeAdvancedCarePlanning']) // only valid relationship
        ->where('uuid', $uuid)
        ->firstOrFail();

    // ✅ Directly use stored signature (no encoding needed)
    $signatureImage = $supportPlan->approval->signature ?? null;

    $pdf = Pdf::loadView('pdf.supportplan', compact('supportPlan', 'signatureImage'))
        ->setPaper('A4', 'portrait');


    $fileName = 'Support_Plan_' . ($supportPlan->staff->full_name ?? 'Unknown') . '.pdf';

    return $pdf->download($fileName);
}

// In SupportPlanController.php
public function getSupportPlanUuid(Request $request)
{
    $userId = $request->query('userid');
    $clientType = $request->query('client_type');

    $supportPlan = SupportPlan::where('user_id', $userId)
        ->where('client_type', $clientType)
        ->latest()
        ->first();

    if (!$supportPlan) {
        return response()->json(['uuid' => null], 200);
    }

    return response()->json(['uuid' => $supportPlan->uuid], 200);
}

// remove section
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

        $support =SupportPlan::where('uuid', $uuid)->first();
        if (!$support) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid UUID.',
            ], 404);
        }

        // ✅ Map table name to Model
        $modelMap = [
            'support_plan_service' => \App\Models\SupportPlanService::class,
            'support_plan_my_goal' => \App\Models\SupportPlanMyGoal::class,


        ];

        if (!array_key_exists($table, $modelMap)) {
            return response()->json([
                'status' => false,
                'message' => 'Unsupported table.',
            ], 400);
        }

        $modelClass = $modelMap[$table];

        $record = $modelClass::where('support_plan_id', $support->id)
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
                'initial_enquiry_id' => $support->id,
                'uuid' => $uuid,
                'client_type' => $support->client_type,
                'staff_id' => $support->staff_id,
                'user_id' => $support->user_id,
            ])
            ->log(ucwords(str_replace('_', ' ', $table)) . ' entry deleted');

        return response()->json([
            'status' => true,
            'message' => 'Entry removed successfully.',
        ]);
    }





}
