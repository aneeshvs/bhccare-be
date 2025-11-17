<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreServiceAgreementRequest;
use App\Http\Controllers\Controller;
use App\Models\ServiceAgreement;
use App\Models\ServiceAgreementConsent;
use App\ServiceAgreementService\ServiceAgreementService;
use App\ServiceAgreementService\ServiceAgreementCompletionService;
use App\ServiceAgreementService\ServiceAgreementConsentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Log;

class ServiceAgreementController extends Controller
{
    public function update(
    StoreServiceAgreementRequest $request,
    ServiceAgreementService $service,
    ServiceAgreementCompletionService $completionService,
    ServiceAgreementConsentService $serviceAgreementConsentService
) {
    $data = $request->validated();

    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

    // must have auth user
    $user = Auth::user();
    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // attach staff
    $staff = \App\Models\Staff::where('user_id', $user->id)->first();
    $data['staff_id'] = $staff?->id ?? null;

    // ----------------------- TRANSACTION -------------------------
    $result = DB::transaction(function () use (
        $data,
        $service,
        $completionService,
        $serviceAgreementConsentService
    ) {

        // save main agreement
        $agreement = $service->save($data);
        $data['service_agreement_id'] = $agreement->id;

        // save consent section
        $serviceAgreementConsentService->save($data);

        // calculate completion
        $completion = $completionService->calculate($agreement);
        $agreement->completion_percentage = $completion;

        $formStatus = $data['form_status'];

        // update status
        if ($formStatus === 'completed') {
            $agreement->form_status = 'completed';
        }

        $agreement->save();

        return [
            'agreement'    => $agreement,
            'completion'   => $completion,
        ];
    });
    // -------------------------- END TRANSACTION -------------------------

    $agreement  = $result['agreement'];
    $completion = $result['completion'];

    // ------------------ REPORT STATUS TO CORE PHP ---------------------
    try {
        Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
            'uuid'                  => (string) $agreement->uuid,
            'form_name'             => 'service_agreement',
            'completion_percentage' => $completion,
            'form_status'           => $agreement->form_status,
        ]);
    } catch (\Exception $e) {
        Log::error("Service Agreement status API error: " . $e->getMessage());
    }

    // ----------------- AFTER TRANSACTION → PDF GENERATION --------------
    if ($agreement->form_status === 'completed') {
        try {
            // ⭐ Generate PDF
            $pdf = Pdf::loadView('pdf.serviceagreement', [
                'serviceAgreement' => $agreement->load([
                    'consent',
                    'staff'
                ]),
            ])->setPaper('A4', 'portrait');

            $fileName = 'Service_Agreement_' . ($agreement->full_name ?? 'Record') . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ⭐ Upload PDF → Core PHP Document API
            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';

            $staffEmail = $agreement->staff?->email ?? null;

            $response = Http::attach(
                'doc',
                file_get_contents($filePath),
                $fileName
            )->asMultipart()->post($corePhpUrl, [
                'userid'    => $agreement->user_id,
                'title'     => 'Service Agreement',
                'comments'  => 'Agreement completed successfully.',
                'companyid' => $agreement->company_id ?? 1,
                 'staff_email' => $staffEmail,            ]);

            if (!$response->successful()) {
                Log::warning("⚠ Failed upload service agreement pdf", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }

            @unlink($filePath);

        } catch (\Exception $e) {
            Log::error("❌ Service Agreement PDF/upload failed: " . $e->getMessage());
        }
    }

    // ---------------------- FINAL RESPONSE ------------------------------
    return response()->json([
        'success' => true,
        'status'  => 200,
        'message' => 'Service Agreement saved successfully.',
        'data'    => [
            'serviceAgreement' => $agreement->load(['consent','staff']),
        ],
    ]);
}





    public function showByUuid( string $uuid, ServiceAgreementCompletionService $completionService)
{
    // ✅ Load all related relationships if needed
    $serviceAgreement = ServiceAgreement::with([
        'consent'


    ])->where('uuid', $uuid)->first();

    if (!$serviceAgreement) {
        return response()->json([
            'success' => false,
            'message' => 'Service Agreement not found'
        ], 404);
    }

    // ✅ New Completion Logic
    $completion = $completionService->calculate($serviceAgreement);
    $serviceAgreement->completion_percentage = $completion;

    return response()->json([
        'success' => true,
        'data' => $serviceAgreement,
    ]);
}

public function exportFullFormPdf(string $uuid)
{
    $serviceAgreement = ServiceAgreement::with(['staff','consent']) // add other relationships if any
        ->where('uuid', $uuid)
        ->firstOrFail();

    $pdf = Pdf::loadView('pdf.serviceagreement', compact('serviceAgreement'))
        ->setPaper('A4', 'portrait');

    $fileName = 'Service_Agreement_' . ($serviceAgreement->staff->name ?? 'Unknown') . '.pdf';

    return $pdf->download($fileName);
}

// In ServiceAgreementController.php
public function getServiceAgreementUuid(Request $request)
{
    $userId = $request->query('userid');
    $clientType = $request->query('client_type');

    $serviceAgreement = ServiceAgreement::where('user_id', $userId)
        ->where('client_type', $clientType)
        ->latest()
        ->first();

    if (!$serviceAgreement) {
        return response()->json(['uuid' => null], 200);
    }

    return response()->json(['uuid' => $serviceAgreement->uuid], 200);
}


}
