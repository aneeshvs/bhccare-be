<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingPackingSignoffRequest;
use App\Models\OnboardingPackingSignoff;

use App\Models\OnboardingPackingSignoffParticipantDeclaration;
use App\OnboardingPackingSignoffService\OnboardingPackingSignoffService;
use App\OnboardingPackingSignoffService\OnboardingPackingSignoffCompletionService;
use App\OnboardingPackingSignoffService\OnboardingPackingSignoffDisabilityActDiscussionService;
use App\OnboardingPackingSignoffService\OnboardingPackingSignoffParticipantDeclarationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class OnboardingPackingSignoffController extends Controller
{
    public function update(
    StoreOnboardingPackingSignoffRequest $request,
    OnboardingPackingSignoffService $service,
    OnboardingPackingSignoffCompletionService $completionService,
    OnboardingPackingSignoffDisabilityActDiscussionService $DisabilityActDiscussionService,
    OnboardingPackingSignoffParticipantDeclarationService $ParticipantDeclarationService
) {
    $data = $request->validated();
    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

    Log::info('🔹 OnboardingPackingSignoff update started', [
        'data' => $data,
        'isFinal' => $isFinal,
    ]);

    $user = Auth::user();
    if (!$user) {
        Log::warning('❌ Unauthorized access attempt');
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Attach staff
    $staff = \App\Models\Staff::where('user_id', $user->id)->first();
    $data['staff_id'] = $staff?->id ?? null;

    // ---------------------- TRANSACTION ----------------------
    $result = DB::transaction(function () use (
        $data,
        $service,
        $completionService,
        $DisabilityActDiscussionService,
        $ParticipantDeclarationService
    ) {
        // Save main record
        $record = $service->save($data);

        // Save child records
        $data['onboarding_packing_signoff_id'] = $record->id;
        $DisabilityActDiscussionService->save($data);
        $ParticipantDeclarationService->save($data);

        // Calculate completion
        $completion = $completionService->calculate($record);
        $record->completion_percentage = $completion;

        if ($data['form_status'] === 'completed') {
            $record->form_status = 'completed';
        }

        $record->save();

        Log::info('✅ PackingSignoff saved', [
            'uuid' => $record->uuid,
            'completion_percentage' => $record->completion_percentage,
            'form_status' => $record->form_status,
        ]);

        return [
            'record' => $record,
            'completion' => $completion
        ];
    });
    // ---------------------- END TRANSACTION ----------------------

    $record     = $result['record'];
    $completion = $result['completion'];

    // ------------------ SEND STATUS TO CORE PHP ------------------
    $payload = [
        'uuid' => (string) $record->uuid,
        'form_name' => 'onboarding-packing-signoff',
        'completion_percentage' => $completion,
        'form_status' => $record->form_status,
    ];

    Log::info('📤 Sending form_status to Core PHP', $payload);

    try {
        $response = Http::asForm()->post(
            config('services.core_php.base_url') . '/update-form-status.php',
            $payload
        );

        if ($response->failed()) {
            Log::error('❌ Core PHP form-status failed', [
                'response' => $response->body(),
                'status' => $response->status(),
            ]);
        }
    } catch (\Exception $e) {
        Log::error('❌ Core PHP form-status exception: ' . $e->getMessage());
    }

    // ------------------- PDF GENERATION & UPLOAD -------------------
    if ($record->form_status === 'completed') {

        try {
            // ⭐ Generate PDF
            $pdf = Pdf::loadView('pdf.onboardingpacking', [
                'record' => $record->load([
                    'staff',
                    'disabilityActDiscussion',
                    'participantDeclaration'
                ])
            ])->setPaper('A4', 'portrait');

            $fileName = 'Onboarding_Packing_Signoff_' . ($record->full_name ?? 'Form') . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ⭐ Upload PDF to Core PHP
            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';
            $staffEmail = $record->staff?->email ?? null;


            $fileUploadResponse = Http::attach(
                'doc',
                file_get_contents($filePath),
                $fileName
            )->asMultipart()->post($corePhpUrl, [
                'userid'    => $record->user_id,
                'title'     => 'Onboarding Packing Signoff',
                'comments'  => 'Form completed successfully.',
                'companyid' => $record->company_id ?? 1,
                'staff_email' => $staffEmail,
            ]);

            if (!$fileUploadResponse->successful()) {
                Log::warning('⚠ Document upload failed', [
                    'status' => $fileUploadResponse->status(),
                    'body' => $fileUploadResponse->body(),
                ]);
            }

            // delete temporary file
            @unlink($filePath);

        } catch (\Exception $e) {
            Log::error('❌ PDF generation/upload failed: ' . $e->getMessage());
        }
    }

    // ---------------- FINAL RESPONSE ----------------
    return response()->json([
        'success' => true,
        'status'  => 200,
        'message' => 'Onboarding Packing Signoff saved successfully.',
        'data'    => [
            'onboardingPackingSignoff' => $record->load([
                'staff',
                'disabilityActDiscussion',
                'participantDeclaration'
            ]),
        ],
    ]);
}




/**
 * CLIENT: Signature ONLY update (public)
 */
public function clientSignatureUpdate(Request $request)
{
    Log::info('📝 Client ONLY signature update started');
    
    // Validate ONLY signature fields
    $validated = $request->validate([
        'uuid' => 'required|string',
        // 'participant_name' => 'required|string|max:255',
        // 'relationship_to_participant' => 'required|string|max:255',
        'participant_signature' => 'required|string',
        'signed_date' => 'nullable|date',
       
    ]);
    
    // Find the parent form
    $parentRecord = OnboardingPackingSignoff::where('uuid', $validated['uuid'])->first();
    
    if (!$parentRecord) {
        return response()->json([
            'success' => false,
            'message' => 'Form not found'
        ], 404);
    }
    
    // ⭐ UPDATE ONLY the participant declaration child record
    $participantDeclaration = OnboardingPackingSignoffParticipantDeclaration::updateOrCreate(
        [
            'onboarding_packing_signoff_id' => $parentRecord->id
        ],
        [
            // 'participant_name' => $validated['participant_name'],
            // 'relationship_to_participant' => $validated['relationship_to_participant'],
            'participant_signature' => $validated['participant_signature'],
            'signed_date' => $validated['signed_date'],
        ]
    );
    
    Log::info('✅ Client signature saved', [
        'parent_id' => $parentRecord->id,
        'declaration_id' => $participantDeclaration->id,
    ]);
    
    
    
    return response()->json([
        'success' => true,
        'message' => 'Signature saved successfully',
        'data' => [
            'uuid' => $parentRecord->uuid,
            'participant_name' => $participantDeclaration->participant_name,
            'relationship_to_participant' => $participantDeclaration->relationship_to_participant,
            'signed_date' => $participantDeclaration->signed_date,
        ]
    ]);
}



    public function showByUuid(string $uuid, OnboardingPackingSignoffCompletionService $completionService)
    {
        // Load staff relationship (if any)
        $record = OnboardingPackingSignoff::with('staff','disabilityActDiscussion','participantDeclaration')
            ->where('uuid', $uuid)
            ->first();

        // Handle not found case
        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found',
            ], 404);
        }

        // Calculate completion percentage using the service
        $completionPercentage = $completionService->calculate($record);
        $record->completion_percentage = $completionPercentage;

        // Return structured response
        return response()->json([
            'success' => true,
            'data' => $record->toArray(),
        ]);
    }



        public function exportFullFormPdf(string $uuid)
    {
        $record = OnboardingPackingSignoff::with('staff','disabilityActDiscussion','participantDeclaration')->where('uuid', $uuid)->firstOrFail();

        $pdf = Pdf::loadView('pdf.onboardingpacking', [
            'record' => $record,
        ])->setPaper('A4', 'portrait');

        $fileName = 'Onboarding_Packing_Sign_Off_' . ($record->staff->name ?? 'Unknown') . '.pdf';

        return $pdf->download($fileName);
    }

    public function getUuid(Request $request)
    {
        $userId = $request->query('userid');
        $clientType = $request->query('client_type');

        $record = OnboardingPackingSignoff::where('user_id', $userId)
            ->where('client_type', $clientType)
            ->latest()
            ->first();

        return response()->json(['uuid' => $record?->uuid ?? null]);
    }


}
