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
use App\HomeSafetyChecklistAssessmentService\HomeSafetyResidenceTypeService;
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
    HallwaysSafetyCheckService $hallwaysSafetyCheckService,
    KitchenBathroomSafetyCheckService $kitchenBathroomSafetyCheckService,
    OutsideResidenceAssessmentService $outsideResidenceAssessmentService,
    HomeSafetyMiscellaneousService $homeSafetyMiscellaneousService,
    HomeSafetyResidenceTypeService $homeSafetyResidenceTypeService
) {
    $data = $request->validated();
    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

    // ⭐ DB Transaction
    $assessment = DB::transaction(function () use (
        $data,
        $service,
        $completionService,
        $homeSafetyOutsideEntryService,
        $homeSafetyInsideResidenceService,
        $hallwaysSafetyCheckService,
        $kitchenBathroomSafetyCheckService,
        $outsideResidenceAssessmentService,
        $homeSafetyMiscellaneousService,
        $homeSafetyResidenceTypeService
    ) {

        $user = Auth::user();
        if (!$user) {
            abort(401, 'Unauthorized');
        }

        $staff = \App\Models\Staff::where('user_id', $user->id)->first();
        $data['staff_id'] = $staff?->id ?? null;

        // ⭐ Save Base Form
        $assessment = $service->save($data);
        $data['home_safety_checklist_assessment_id'] = $assessment->id;

        // ⭐ Save child sections
        $homeSafetyOutsideEntryService->save($data);
        $homeSafetyInsideResidenceService->save($data);
        $hallwaysSafetyCheckService->save($data);
        $kitchenBathroomSafetyCheckService->save($data);
        $outsideResidenceAssessmentService->save($data);
        $homeSafetyMiscellaneousService->save($data);
        $homeSafetyResidenceTypeService->save($data);

        // ⭐ Completion %
        $completion = $completionService->calculate($assessment);
        $assessment->completion_percentage = $completion;

        if ($data['form_status'] === 'completed') {
            $assessment->form_status = 'completed';
        }

        $assessment->save();

        // ⭐ Report to Core PHP
        try {
            Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                'uuid' => (string) $assessment->uuid,
                'form_name' => 'home_safety_checklist_assessment',
                'completion_percentage' => $completion,
                'form_status' => $data['form_status'],
            ]);
        } catch (\Exception $e) {
            Log::error('⚠ Error calling Core PHP update-form-status: '.$e->getMessage());
        }

        return $assessment;
    });

    // ⭐ After transaction → Generate PDF + Upload to Core PHP
    if ($data['form_status'] === 'completed') {

        try {
            // ⭐ Generate PDF
            $pdf = Pdf::loadView('pdf.home_safety_assessment', [
                'assessment' => $assessment->load([
                    'outsideEntry',
                    'insideResidence',
                    'hallways',
                    'hallwaysSafetyAssessment',
                    'outsideResidenceAssessment',
                    'miscellaneous',
                    'residenceType',
                    'staff'
                ])
            ])->setPaper('A4', 'portrait');

            $fileName = 'Home_Safety_Checklist_' . $assessment->full_name . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ⭐ Push PDF to Core PHP
            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';
             $staffEmail = $assessment->staff?->email ?? null;

            $response = Http::attach(
                'doc',
                file_get_contents($filePath),
                $fileName
            )->asMultipart()->post($corePhpUrl, [
                'userid'    => $assessment->user_id,
                'title'     => 'Home Safety Checklist Assessment',
                'comments'  => 'Form completed successfully.',
                'companyid' => $assessment->company_id ?? 1,
                'staff_email' => $staffEmail,
            ]);

            if (!$response->successful()) {
                Log::warning('⚠ PDF upload failed for Home Safety Checklist', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

            @unlink($filePath);

        } catch (\Exception $e) {
            Log::error('❌ PDF Generation/Upload Failed: '.$e->getMessage());
        }
    }

    // ⭐ Final API Response
    return response()->json([
    'success' => true,
    'message' => 'Home Safety Checklist Assessment saved successfully.',
    'data' => [
        'homeSafetyChecklistAssessment' => $assessment->load([
            'outsideEntry',
            'insideResidence',
            'hallways',
            'hallwaysSafetyAssessment',
            'outsideResidenceAssessment',
            'miscellaneous',
            'residenceType'
        ])
    ],
]);
}




public function showByUuid(string $uuid, HomeSafetyChecklistCompletionService $completionService)
{

    $assessment = HomeSafetyChecklistAssessment::with(['outsideEntry','insideResidence',
    'hallways','hallwaysSafetyAssessment','outsideResidenceAssessment','miscellaneous','residenceType'

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


    public function exportFullFormPdf(string $uuid)
{
    $assessment = HomeSafetyChecklistAssessment::with([
        'staff',
        'outsideEntry',
        'insideResidence',
        'hallways',
        'hallwaysSafetyAssessment',
        'outsideResidenceAssessment',
        'miscellaneous',
        'residenceType'
    ])->where('uuid', $uuid)->firstOrFail();

    $pdf = Pdf::loadView('pdf.home_safety_assessment', compact('assessment'))
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
