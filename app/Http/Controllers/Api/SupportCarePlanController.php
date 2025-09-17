<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSupportCarePlanRequest;
use App\Http\Controllers\Controller;
use App\Models\SupportCarePlan;

use App\SupportCarePlanService\SupportCarePlanService;
use App\SupportCarePlanService\SupportCarePlanCompletionService;
use App\SupportCarePlanService\AlternateDecisionMakerService;
use App\SupportCarePlanService\SilGoalService;
use App\SupportCarePlanService\SupportCoordinationGoalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupportCarePlanController extends Controller
{
    public function update(
        StoreSupportCarePlanRequest $request,
        SupportCarePlanService $service,
        SupportCarePlanCompletionService $completionService,
        AlternateDecisionMakerService $alternateDecisionMakerService,
        SilGoalService $silGoalService,
        SupportCoordinationGoalService $supportCoordinationGoalService
    ) {
        $data = $request->validated();

        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use (
            $data,
            $service,
            $completionService,
            $alternateDecisionMakerService,
            $silGoalService,
            $supportCoordinationGoalService,
        ) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // ✅ Attach staff
            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            // ✅ Save main Support Care Plan
            $plan = $service->save($data);
             $data['support_care_plan_id'] = $plan->id;

             $alternateDecisionMakerService->save($data);
             $silGoalService->saveMany($data['sil_goals'] ?? [], $plan->id, 'sil');
            $silGoalService->saveMany($data['support_coordination_goals'] ?? [], $plan->id, 'support_coordination');
            $silGoalService->saveMany($data['homecare_goals'] ?? [], $plan->id, 'homecare');

            // ✅ Calculate completion %
            $completion = $completionService->calculate($plan);
            $plan->completion_percentage = $completion;

            // ✅ Report status to Core PHP
            $formStatus = $data['form_status'] ?? 'in_progress';

            try {
                Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
                    'uuid' => (string) $plan->uuid,
                    'form_name' => 'support_care_plan',
                    'completion_percentage' => $completion,
                    'form_status' => $formStatus,
                ]);
            } catch (\Exception $e) {
                Log::error('Error reporting Support Care Plan status: ' . $e->getMessage());
            }

            if ($formStatus === 'completed') {
                $plan->form_status = 'completed';
                $plan->save();
            }

            return [
               'serviceAgreement' => $plan->load([
               'alternateDecisionMaker',
               'silGoals',
               'supportCoordinationGoals',
               'homecareGoals',

                ]),
            ];
        });

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Support Care Plan saved successfully.',
            'data' => $result,
        ]);
    }

    public function showByUuid($uuid, SupportCarePlanCompletionService $completionService)
    {
        $plan = SupportCarePlan::with(['alternateDecisionMaker','silGoals','supportCoordinationGoals','homecareGoals']) // add child relationships if any
            ->where('uuid', $uuid)
            ->first();

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Support Care Plan not found'
            ], 404);
        }

        $completion = $completionService->calculate($plan);
        $plan->completion_percentage = $completion;

        return response()->json([
            'success' => true,
            'data' => $plan->toArray(),
        ]);
    }

        public function exportFullFormPdf(string $uuid)
    {
        $supportCarePlan = SupportCarePlan::with(['staff','alternateDecisionMaker','silGoals','supportCoordinationGoals']) // load staff relationship
            ->where('uuid', $uuid)
            ->firstOrFail();

        $pdf = Pdf::loadView('pdf.supportcareplan', compact('supportCarePlan'))
            ->setPaper('A4', 'portrait');

        $fileName = 'Support_Care_Plan_' . ($supportCarePlan->staff->name ?? 'Unknown') . '.pdf';

        return $pdf->download($fileName);
    }


    public function getSupportCarePlanUuid(Request $request)
    {
        $userId = $request->query('userid');
        $clientType = $request->query('client_type');

        $plan = SupportCarePlan::where('user_id', $userId)
            ->where('client_type', $clientType)
            ->latest()
            ->first();

        if (!$plan) {
            return response()->json(['uuid' => null], 200);
        }

        return response()->json(['uuid' => $plan->uuid], 200);
    }
}
