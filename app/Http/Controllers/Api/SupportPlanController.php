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
use App\Models\SupportPlanCarePartner;
use App\Models\SupportPlanContactDetailSecondary;
use App\SupportplanService\CulturalDiversityService;
use App\SupportplanService\SupportPlanLivingArrangementService;
use App\SupportplanService\SupportPlanMyGoalService;
use App\SupportplanService\SupportPlanServiceService;
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





        // ✅ New Completion Logic
        $completion = $completionService->calculate($supportPlan);
        $supportPlan->completion_percentage = $completion;

        // ✅ Report status
        $formStatus = $data['form_status'] ?? 'in_progress';

        try {
            Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
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
        ])
    ];



    });
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
    'supportplan_employee','myGoals','LivingArrangement','cultural_diversity'])->where('uuid', $uuid)->firstOrFail();

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
    'supportplan_employee','myGoals','LivingArrangement','cultural_diversity']) // only valid relationship
        ->where('uuid', $uuid)
        ->firstOrFail();

    $pdf = Pdf::loadView('pdf.supportplan', compact('supportPlan'))
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
