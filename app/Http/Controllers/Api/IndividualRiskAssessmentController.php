<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndividualRiskAssessmentRequest;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentCognitionService;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentCommunicationService;
use App\Models\IndividualRiskAssessment;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentService;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentCompletionService;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentDetailService;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentMobilityService;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentPersonalCareSupportService;
use App\IndividualRiskAssessmentService\IndividualRiskAssessmentViolenceRiskService;
use App\IndividualRiskAssessmentService\PlanManualHandlingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class IndividualRiskAssessmentController extends Controller
{
    public function update(
    StoreIndividualRiskAssessmentRequest $request,
    IndividualRiskAssessmentService $service,
    IndividualRiskAssessmentCompletionService $completionService,
    IndividualRiskAssessmentDetailService $detailService,
    IndividualRiskAssessmentCommunicationService $communicationService,
    IndividualRiskAssessmentCognitionService $cognitionService,
    IndividualRiskAssessmentMobilityService $mobilityService,
    IndividualRiskAssessmentPersonalCareSupportService $personalCareSupportService,
    PlanManualHandlingService $manualHandlingService,
    IndividualRiskAssessmentViolenceRiskService $violenceRiskService
) {
    $data = $request->validated();
    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

    // ⭐ DB TRANSACTION — SAME AS HOME SAFETY
    $assessment = DB::transaction(function () use (
        $data,
        $service,
        $completionService,
        $detailService,
        $communicationService,
        $cognitionService,
        $mobilityService,
        $personalCareSupportService,
        $manualHandlingService,
        $violenceRiskService
    ) {

        $user = Auth::user();
        if (!$user) {
            abort(401, 'Unauthorized');
        }

        $staff = \App\Models\Staff::where('user_id', $user->id)->first();
        $data['staff_id'] = $staff?->id ?? null;

        // ⭐ Save main form
        $assessment = $service->save($data);
        $data['individual_risk_assessment_id'] = $assessment->id;

        // ⭐ Save all child sections
        $detailService->save($data);
        $communicationService->save($data);
        $cognitionService->save($data);
        $mobilityService->save($data);
        $personalCareSupportService->save($data);

        // ⭐ Save manual handling (multi-row)
        $manualHandlingService->saveMany(
            $data['manual_handlings'] ?? [],
            $assessment->id
        );

        $violenceRiskService->save($data);

        // ⭐ Calculate completion
        $completion = $completionService->calculate($assessment);
        $assessment->completion_percentage = $completion;

        // ⭐ Mark as completed
        if ($data['form_status'] === 'completed') {
            $assessment->form_status = 'completed';
        }

        $assessment->save();

        // ⭐ Report to Core PHP
        try {
            Http::asForm()->post(
                config('services.core_php.base_url') . '/update-form-status.php',
                [
                    'uuid' => (string)$assessment->uuid,
                    'form_name' => 'individual_risk_assessment',
                    'completion_percentage' => $completion,
                    'form_status' => $data['form_status'],
                ]
            );
        } catch (\Exception $e) {
            Log::error('⚠ Error calling Core PHP update-form-status: ' . $e->getMessage());
        }

        return $assessment;
    });

    // ⭐ AFTER TRANSACTION → PDF GENERATION (same as home safety)
    if ($data['form_status'] === 'completed') {

        try {
            // ⭐ Generate PDF
            $pdf = Pdf::loadView('pdf.individual_risk_assessment', [
                'assessment' => $assessment->load([
                    'details',
                    'communications',
                    'cognitions',
                    'mobilities',
                    'personalCareSupport',
                    'manualHandlings',
                    'violenceRisk',
                    'staff'
                ])
            ])->setPaper('A4', 'portrait');

            $fileName = 'Individual_Risk_Assessment_' . $assessment->full_name . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ⭐ Upload PDF to Core PHP (add-user-document API)
            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';
            $staffEmail = $assessment->staff?->email ?? null;

            $response = Http::attach(
                'doc',
                file_get_contents($filePath),
                $fileName
            )->asMultipart()->post($corePhpUrl, [
                'userid'    => $assessment->user_id,
                'title'     => 'Individual Risk Assessment',
                'comments'  => 'Form completed successfully.',
                'companyid' => $assessment->company_id ?? 1,
                'staff_email' => $staffEmail,
            ]);

            if (!$response->successful()) {
                Log::warning('⚠ PDF upload failed for Individual Risk Assessment', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

            @unlink($filePath);

        } catch (\Exception $e) {
            Log::error('❌ PDF Generation/Upload Failed: ' . $e->getMessage());
        }
    }

    // ⭐ FINAL API RESPONSE
    return response()->json([
        'success' => true,
        'message' => 'Individual Risk Assessment saved successfully.',
        'data' => [ 'individualRiskAssessment' => $assessment->load([
            'details',
            'communications',
            'cognitions',
            'mobilities',
            'personalCareSupport',
            'manualHandlings',
            'violenceRisk'

            ]),

        ],

    ]);
}

    public function showByUuid(string $uuid, IndividualRiskAssessmentCompletionService $completionService)
    {
        $assessment = IndividualRiskAssessment::with('details','communications','cognitions','mobilities',
        'personalCareSupport','manualHandlings','violenceRisk')->where('uuid', $uuid)->first();

        if (!$assessment) {
            return response()->json([
                'success' => false,
                'message' => 'Risk Assessment not found',
            ], 404);
        }

        $completion = $completionService->calculate($assessment);
        $assessment->completion_percentage = $completion;

        return response()->json([
            'success' => true,
            'data' => $assessment->toArray(),
        ]);
    }

    public function exportFullFormPdf(string $uuid)
    {
        $assessment = IndividualRiskAssessment::with('staff','details','communications',
        'cognitions','mobilities','personalCareSupport','manualHandlings','violenceRisk')
            ->where('uuid', $uuid)
            ->firstOrFail();

        $pdf = Pdf::loadView('pdf.individual_risk_assessment', compact('assessment'))
            ->setPaper('A4', 'portrait');

        $fileName = 'Individual_Risk_Assessment_' . ($assessment->staff->name ?? 'Unknown') . '.pdf';

        return $pdf->download($fileName);
    }

    public function getRiskAssessmentUuid(Request $request)
    {
        $userId = $request->query('userid');
        $clientType = $request->query('client_type');

        $assessment = IndividualRiskAssessment::where('user_id', $userId)
            ->where('client_type', $clientType)
            ->latest()
            ->first();

        return response()->json(['uuid' => $assessment?->uuid], 200);
    }


    public function removeSectionRiskAssessment(Request $request)
{
    $uuid = $request->input('uuid');
    $table = $request->input('table'); // e.g., 'individual_risk_assessment_detail'
    $field = $request->input('field'); // e.g., 'risk_title'
    $value = $request->input('value'); // e.g., 'Slips and falls'

    if (!$uuid || !$table || !$field || !$value) {
        return response()->json([
            'status' => false,
            'message' => 'uuid, table, field, and value are required.',
        ], 400);
    }

    // ✅ Validate UUID against main IndividualRiskAssessment
    $riskAssessment = \App\Models\IndividualRiskAssessment::where('uuid', $uuid)->first();

    if (!$riskAssessment) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID. No Risk Assessment found.',
        ], 404);
    }

    // ✅ Map table names to models
    $modelMap = [

        'plan_manual_handlings'=> \App\Models\PlanManualHandling::class,
    ];

    if (!array_key_exists($table, $modelMap)) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid table name provided.',
        ], 400);
    }

    $modelClass = $modelMap[$table];

    // ✅ Find record for deletion
    $record = $modelClass::where('individual_risk_assessment_id', $riskAssessment->id)
        ->where($field, $value)
        ->first();

    if (!$record) {
        return response()->json([
            'status' => false,
            'message' => 'Record not found for deletion.',
        ], 404);
    }

    // Capture old data before delete
    $oldData = $record->getOriginal();

    // ✅ Delete record
    $record->delete();

    // ✅ Log deletion in activity log
    activity()
        ->useLog($table)
        ->performedOn($record)
       ->causedBy(Auth::user())
        ->withProperties([
            'attributes' => [$field => $value],
            'old' => $oldData,
            'individual_risk_assessment_id' => $riskAssessment->id,
            'uuid' => $uuid,
            'user_id' => $riskAssessment->user_id,
            'client_type' => $riskAssessment->client_type,
            'staff_id' => $riskAssessment->staff_id,
        ])
        ->log(ucwords(str_replace('_', ' ', $table)) . ' record deleted');

    return response()->json([
        'status' => true,
        'message' => 'Record removed successfully.',
    ]);
}

}
