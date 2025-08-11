<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Requests\StoreSupportPlanRequest;
use App\SupportplanService\SupportPlanService;
use App\SupportplanService\SupportPlanCompletionService;
use App\SupportplanService\SupportPlanApprovalService;
use App\SupportplanService\SupportPlanRepresentativeService;
use App\SupportplanService\SupportPlanCarePartnerService;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\SupportPlan;

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
SupportPlanCarePartnerService $carePartnerService,)
{
    $data = $request->validated();
    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';



    $result=DB::transaction(function () use ($data, $service,
     $completionService,
     $approvalService,
     $representativeService,
     $carePartnerService,
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

        return compact(
                'supportPlan','approval','representative','carePartner'
            );

    });
        return response()->json([
            'success' => true, // ✅ this is expected by frontend
            'status' => 200,
            'message' => 'Support Plan saved successfully.',
            'data' => $result,
        ]);

}



public function showByUuid($uuid)
{
    $supportPlan = SupportPlan::with(['approval','representativeApproval','careApproval'])->where('uuid', $uuid)->firstOrFail();

    if (!$supportPlan) {
        return response()->json(['success' => false, 'message' => 'Support Plan not found'], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $supportPlan,
    ]);
}


public function exportFullFormPdf(string $uuid)
{
    $supportPlan = SupportPlan::with(['staff','approval','representativeApproval','careApproval']) // only valid relationship
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




}
