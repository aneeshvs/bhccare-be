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

use App\Models\ParticipantSignature;


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



public function clientUpdateServiceAgreementConsent(Request $request)
{
    Log::info('📝 Client updating ServiceAgreementConsent via UUID');

    $validated = $request->validate([
        'uuid' => 'required|string',
        'user_id' => 'required|integer',
        
        // Client-controlled fields
        'consents_participant_name' => 'nullable|string|max:255',
       
        'participant_signature' => 'nullable|string',
        'participant_date' => 'nullable|date',
        
        'witness_name' => 'nullable|string|max:255',
        'witness_signature' => 'nullable|string',
        'witness_date' => 'nullable|date',
        
        'verbal_staff_name' => 'nullable|string|max:255',
        'verbal_staff_signature' => 'nullable|string',
        'verbal_staff_position' => 'nullable|string|max:255',
        'verbal_date' => 'nullable|date',
        
        'other_notes' => 'nullable|string',
        'received_signed_copy' => 'nullable|boolean',
        'agreed_verbally' => 'nullable|boolean',
       
    ]);

    // Find parent ServiceAgreement by UUID and user_id
    $parentRecord = ServiceAgreement::where('uuid', $validated['uuid'])
        ->where('user_id', $validated['user_id'])
        ->first();

    if (!$parentRecord) {
        return response()->json([
            'success' => false,
            'message' => 'Service Agreement not found or access denied'
        ], 404);
    }

    // Update or create the ServiceAgreementConsent
    $consentRecord = ServiceAgreementConsent::updateOrCreate(
        [
            'service_agreement_id' => $parentRecord->id
        ],
        [
            // Participant fields
            'consents_participant_name' => $validated['consents_participant_name'],
          
            'participant_signature' => $validated['participant_signature'],
            'participant_date' => $validated['participant_date'],
            
            // Witness fields
            'witness_name' => $validated['witness_name'],
            'witness_signature' => $validated['witness_signature'],
            'witness_date' => $validated['witness_date'],
            
            // Verbal consent fields
            'verbal_staff_name' => $validated['verbal_staff_name'],
            'verbal_staff_signature' => $validated['verbal_staff_signature'],
            'verbal_staff_position' => $validated['verbal_staff_position'],
            'verbal_date' => $validated['verbal_date'],
            
            // Other fields
            'other_notes' => $validated['other_notes'],
            'received_signed_copy' => $validated['received_signed_copy'],
            'agreed_verbally' => $validated['agreed_verbally'],
          
        ]
    );

    Log::info('✅ Client updated Service Agreement Consent', [
        'service_agreement_id' => $parentRecord->id,
        'consent_id' => $consentRecord->id,
        'client_id' => $validated['user_id']
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Service Agreement Consent saved successfully',
        'data' => [
            'uuid' => $parentRecord->uuid,
            'participant_details' => [
                'name' => $consentRecord->consents_participant_name,
              
                'date' => $consentRecord->participant_date,
                'has_signature' => !empty($consentRecord->participant_signature),
            ],
            'witness_details' => [
                'name' => $consentRecord->witness_name,
                'date' => $consentRecord->witness_date,
                'has_signature' => !empty($consentRecord->witness_signature),
            ],
            'verbal_consent' => [
                'staff_name' => $consentRecord->verbal_staff_name,
                'position' => $consentRecord->verbal_staff_position,
                'date' => $consentRecord->verbal_date,
                'has_signature' => !empty($consentRecord->verbal_staff_signature),
                'agreed_verbally' => $consentRecord->agreed_verbally,
            ],
            'status' => [
                'received_signed_copy' => $consentRecord->received_signed_copy,
               
            ],
            'other_notes' => $consentRecord->other_notes,
        ]
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
