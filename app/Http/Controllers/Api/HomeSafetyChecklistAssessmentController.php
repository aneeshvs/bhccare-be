<?php

namespace App\Http\Controllers\Api;

use App\HomeSafetyChecklistAssessmentService\HallwaysSafetyCheckService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeSafetyChecklistAssessmentRequest;
use App\Models\HomeSafetyChecklistAssessment;
use App\HomeSafetyChecklistAssessmentService\HomeSafetyChecklistAssessmentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use App\HomeSafetyChecklistAssessmentService\HomeSafetyChecklistCompletionService;
use App\HomeSafetyChecklistAssessmentService\HomeSafetyInsideResidenceService;
use App\HomeSafetyChecklistAssessmentService\HomeSafetyMiscellaneousService;
use App\HomeSafetyChecklistAssessmentService\HomeSafetyOutsideEntryService;
use App\HomeSafetyChecklistAssessmentService\KitchenBathroomSafetyCheckService;
use App\HomeSafetyChecklistAssessmentService\OutsideResidenceAssessmentService;

class HomeSafetyChecklistAssessmentController extends Controller
{
    public function update(
        StoreHomeSafetyChecklistAssessmentRequest $request,
        HomeSafetyChecklistAssessmentService $service,
        HomeSafetyChecklistCompletionService $completionService,
        HomeSafetyOutsideEntryService $homeSafetyOutsideEntryService,
        HomeSafetyInsideResidenceService $homeSafetyInsideResidenceService,
        HallwaysSafetyCheckService  $hallwaysSafetyCheckService,
        KitchenBathroomSafetyCheckService $kitchenBathroomSafetyCheckService,
        OutsideResidenceAssessmentService $outsideResidenceAssessmentService,
        HomeSafetyMiscellaneousService $homeSafetyMiscellaneousService,


    ) {
        $data = $request->validated();
        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use ($data, $service,$homeSafetyOutsideEntryService,
        $completionService,$homeSafetyInsideResidenceService,$hallwaysSafetyCheckService,
        $kitchenBathroomSafetyCheckService,$outsideResidenceAssessmentService,$homeSafetyMiscellaneousService,
) {
            $user = Auth::user();
            if (!$user) {
                abort(401, 'Unauthorized');
            }

            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            $assessment = $service->save($data);
            $data['home_safety_checklist_assessment_id'] = $assessment->id;

            $homeSafetyOutsideEntryService->save($data);
            $homeSafetyInsideResidenceService->save($data);

            $hallwaysSafetyCheckService->save($data);
            $kitchenBathroomSafetyCheckService->save($data);
            $outsideResidenceAssessmentService->save($data);
            $homeSafetyMiscellaneousService->save($data);

            $completion = $completionService->calculate($assessment);
            $assessment->completion_percentage = $completion;
            $assessment->save();
            try {
                Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
                    'uuid' => (string) $assessment->uuid,
                    'form_name' => 'home_safety_checklist_assessment',
                    'completion_percentage' => $completion,
                    'form_status' => $data['form_status'],
                ]);
            } catch (\Exception $e) {
                Log::error('Error reporting Home Safety Checklist status: ' . $e->getMessage());
            }

            if ($data['form_status'] === 'completed') {
                $assessment->form_status = 'completed';
                $assessment->save();
            }

            return ['homeSafetyChecklistAssessment' => $assessment->load([
            'outsideEntry','insideResidence','hallways',
            'hallwaysSafetyAssessment','outsideResidenceAssessment','miscellaneous'

            ]),
        ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Home Safety Checklist Assessment saved successfully.',
            'data' => $result,
        ]);
    }



public function showByUuid(string $uuid, HomeSafetyChecklistCompletionService $completionService)
{

    $assessment = HomeSafetyChecklistAssessment::with(['outsideEntry','insideResidence',
    'hallways','hallwaysSafetyAssessment','outsideResidenceAssessment','miscellaneous'

    ])->where('uuid', $uuid)->first();

    if (!$assessment) {
        return response()->json([
            'success' => false,
            'message' => 'Home Safety Assessment not found'
        ], 404);
    }

    // Calculate completion percentage
    $completion = $completionService->calculate($assessment);
    $assessment->completion_percentage = $completion;

    return response()->json([
        'success' => true,
        'data' => $assessment,
        'completion_percentage' => $completion
    ]);
}


    public function exportPdf(string $uuid)
{
    $homeSafety = HomeSafetyChecklistAssessment::with('staff','outsideEntry',
    'insideResidence','hallways','hallwaysSafetyAssessment','outsideResidenceAssessment','miscellaneous')->where('uuid', $uuid)->firstOrFail();
    $pdf = Pdf::loadView('pdf.home_safety_checklist', compact('homeSafety'))
              ->setPaper('A4', 'portrait');

    return $pdf->download('Home_Safety_Checklist_' . ($homeSafety->staff->name ?? 'Unknown') . '.pdf');
}




    public function getHomeSafetyAssessmentUuid(Request $request)
{
    $userId = $request->query('userid');
    $clientType = $request->query('client_type');

    // Fetch latest Home Safety Assessment for given user and client_type
    $assessment = HomeSafetyChecklistAssessment::where('user_id', $userId)
        ->where('client_type', $clientType)
        ->latest()
        ->first();

    if (!$assessment) {
        return response()->json(['uuid' => null], 200);
    }

    return response()->json(['uuid' => $assessment->uuid], 200);
}

}
