<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSupportCarePlanRequest;
use App\Http\Controllers\Controller;
use App\Models\SupportCarePlan;
use App\SupportCarePlanService\SupportCarePlanLocalServicesContactService;
use App\SupportCarePlanService\SupportCarePlanService;
use App\SupportCarePlanService\SupportCarePlanCompletionService;
use App\SupportCarePlanService\AlternateDecisionMakerService;
use App\SupportCarePlanService\SilGoalService;
use App\SupportCarePlanService\SupportCarePlanCommunicationPlanService;
use App\SupportCarePlanService\SupportCoordinationGoalService;
use App\SupportCarePlanService\SupportCarePlanEmergencyContactService;
use App\SupportCarePlanService\SupportCarePlanEmergencyDisasterPlanService;
use App\SupportCarePlanService\SupportCarePlanEmergencyScenarioService;
use App\SupportCarePlanService\SupportCarePlanImportantContactService;
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
        SupportCoordinationGoalService $supportCoordinationGoalService,
        SupportCarePlanCommunicationPlanService $supportCarePlanCommunicationPlanService,
        SupportCarePlanEmergencyDisasterPlanService  $supportCarePlanEmergencyDisasterPlanService,
        SupportCarePlanEmergencyContactService $supportCarePlanEmergencyContactService,
        SupportCarePlanImportantContactService $supportCarePlanImportantContactService,
        SupportCarePlanLocalServicesContactService $supportCarePlanLocalServicesContact,
        SupportCarePlanEmergencyScenarioService $supportCarePlanEmergencyScenarioService


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
            $supportCarePlanCommunicationPlanService,
            $supportCarePlanEmergencyDisasterPlanService,
            $supportCarePlanEmergencyContactService,
            $supportCarePlanImportantContactService,
            $supportCarePlanLocalServicesContact,
            $supportCarePlanEmergencyScenarioService,
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
            $supportCarePlanCommunicationPlanService->save($data);
            $supportCarePlanEmergencyDisasterPlanService->save($data);
            $supportCarePlanImportantContactService->save($data + ['support_care_plan_id' => $plan->id]);


           $supportCarePlanEmergencyContactService->saveMany($data['emergency_contacts'] ?? [], $plan->id);
           $supportCarePlanLocalServicesContact->save($data);
           $supportCarePlanEmergencyScenarioService->save($data);



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
               'supportCarePlan' => $plan->load([
               'alternateDecisionMaker',
               'silGoals',
               'supportCoordinationGoals',
               'homecareGoals',
               'communicationPlans',
               'emergencyDisasterPlan',
               'emergencyContacts',
               'importantContacts',
               'localServicesContact',
               'emergencyScenario'

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

    public function showByUuid(string $uuid, SupportCarePlanCompletionService $completionService)
    {
        $plan = SupportCarePlan::with(['alternateDecisionMaker','silGoals',
        'supportCoordinationGoals','homecareGoals','communicationPlans',
        'emergencyDisasterPlan','emergencyContacts',
        'importantContacts','localServicesContact','emergencyScenario']) // add child relationships if any
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
        $supportCarePlan = SupportCarePlan::with(['staff','alternateDecisionMaker',
        'silGoals','supportCoordinationGoals','homecareGoals',
        'communicationPlans','emergencyDisasterPlan',
        'emergencyContacts','importantContacts','localServicesContact','emergencyScenario']) // load staff relationship
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



public function removeSectionSupportCarePlan(Request $request)
{
    $uuid = $request->input('uuid');
    $table = $request->input('table'); // e.g., 'sil_goals'
    $field = $request->input('field'); // e.g., 'goal_title'
    $value = $request->input('value'); // e.g., 'Increase independence'

    if (!$uuid || !$table || !$field || !$value) {
        return response()->json([
            'status' => false,
            'message' => 'uuid, table, field, and value are required.',
        ], 400);
    }

    $supportCarePlan = SupportCarePlan::where('uuid', $uuid)->first();

    if (!$supportCarePlan) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID. No Support Care Plan found.',
        ], 404);
    }

    $modelMap = [
    'alternate_decision_makers'              => \App\Models\AlternateDecisionMaker::class,
    'sil_goals'                              => \App\Models\SilGoal::class,
    'support_care_plan_communication'        => \App\Models\SupportCarePlanCommunicationPlan::class,
    'support_care_plan_emergency_contacts'   => \App\Models\SupportCarePlanEmergencyContact::class,
    'support_care_plan_important_contacts'   => \App\Models\SupportCarePlanImportantContact::class,
    'support_care_plan_local_services'       => \App\Models\SupportCarePlanLocalServicesContact::class,
    'support_care_plan_emergency_scenarios'  => \App\Models\SupportCarePlanEmergencyScenario::class,
    'support_care_plan_emergency_disaster'   => \App\Models\SupportCarePlanEmergencyDisasterPlan::class,
];


    if (!array_key_exists($table, $modelMap)) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid table name provided.',
        ], 400);
    }

    $modelClass = $modelMap[$table];

    // ✅ Find record to delete
    $record = $modelClass::where('support_care_plan_id', $supportCarePlan->id)
        ->where($field, $value)
        ->first();

    if (!$record) {
        return response()->json([
            'status' => false,
            'message' => 'Record not found for deletion.',
        ], 404);
    }

    $oldData = $record->getOriginal();
    $record->delete();

    // ✅ Log deletion
    activity()
        ->useLog($table)
        ->performedOn($record)
        ->causedBy(Auth::user())
        ->withProperties([
            'attributes' => [$field => $value],
            'old' => $oldData,
            'support_care_plan_id' => $supportCarePlan->id,
            'uuid' => $uuid,
            'user_id' => $supportCarePlan->user_id,
            'client_type' => $supportCarePlan->client_type,
            'staff_id' => $supportCarePlan->staff_id,
        ])
        ->log(ucwords(str_replace('_', ' ', $table)) . ' record deleted');

    return response()->json([
        'status' => true,
        'message' => 'Record removed successfully.',
    ]);
}


}
