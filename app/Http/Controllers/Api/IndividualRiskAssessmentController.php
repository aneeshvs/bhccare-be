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
        IndividualRiskAssessmentDetailService $individualRiskAssessmentDetailService,
        IndividualRiskAssessmentCommunicationService $individualRiskAssessmentCommunicationService,
        IndividualRiskAssessmentCognitionService  $individualRiskAssessmentCognitionService,
        IndividualRiskAssessmentMobilityService  $individualRiskAssessmentMobilityService,
        IndividualRiskAssessmentPersonalCareSupportService $individualRiskAssessmentPersonalCareSupportService,
        PlanManualHandlingService $planManualHandlingService,
        IndividualRiskAssessmentViolenceRiskService  $individualRiskAssessmentViolenceRiskService,

    ) {
        $data = $request->validated();
        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use ($data, $service, $completionService,
        $individualRiskAssessmentDetailService,
        $individualRiskAssessmentCommunicationService,
        $individualRiskAssessmentCognitionService,
        $individualRiskAssessmentMobilityService,
        $individualRiskAssessmentPersonalCareSupportService,

        $planManualHandlingService,
        $individualRiskAssessmentViolenceRiskService,) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Attach staff
            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            // Save main record
            $assessment = $service->save($data);
            $data['individual_risk_assessment_id'] = $assessment->id;


            $individualRiskAssessmentDetailService->save($data);
            $individualRiskAssessmentCommunicationService->save($data);
            $individualRiskAssessmentCognitionService->save($data);
            $individualRiskAssessmentMobilityService->save($data);
            $individualRiskAssessmentPersonalCareSupportService->save($data);

            $planManualHandlingService->saveMany($data['manual_handlings'] ?? [],$assessment->id);
            $individualRiskAssessmentViolenceRiskService->save($data);

            // Calculate completion %
            $completion = $completionService->calculate($assessment);
            $assessment->completion_percentage = $completion;
            $assessment->save();


            // Report to Core PHP
            try {
                Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
                    'uuid' => (string) $assessment->uuid,
                    'form_name' => 'individual_risk_assessment',
                    'completion_percentage' => $completion,
                    'form_status' => $assessment->form_status,
                ]);
            } catch (\Exception $e) {
                Log::error('Error reporting Risk Assessment status: ' . $e->getMessage());
            }


            return ['individualRiskAssessment' => $assessment->load([
            'details',
            'communications',
            'cognitions',
            'mobilities',
            'personalCareSupport',
            'manualHandlings',
            'violenceRisk'

            ]),
       ];



        });


        return response()->json([
            'success' => true,
            'message' => 'Individual Risk Assessment saved successfully.',
            'data' => $result,
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
            dd($assessment->uuid);

        return response()->json(['uuid' => $assessment?->uuid], 200);
    }
}
