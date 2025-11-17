<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantSignatureRequest;
use App\Models\ParticipantSignature;
use App\ParticipantSignatureService\ParticipantSignatureService;
use App\ParticipantSignatureService\ParticipantSignatureCompletionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ParticipantSignatureController extends Controller
{
    /**
     * Store or update Participant Signature form
     */
  public function update(
    StoreParticipantSignatureRequest $request,
    ParticipantSignatureService $service,
    ParticipantSignatureCompletionService $completionService
) {
    $data = $request->validated();

    // determine final or in-progress
    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

    // must have a logged-in user
    $user = Auth::user();
    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // get staff
    $staff = \App\Models\Staff::where('user_id', $user->id)->first();

    $staffEmail = $staff?->email ?? null;
    $staffName  = $staff?->name  ?? 'Admin';

    $data['staff_id'] = $staff?->id ?? null;

    Log::info('Detected STAFF from logged-in user', [
        'user_id'    => $user->id,
        'staff_found'=> (bool) $staff,
        'staff_id'   => $staff?->id,
        'staff_name' => $staffName,
        'staff_email'=> $staffEmail,
        'staff_type' => $staff?->stafftype,
    ]);

    // MAIN TRANSACTION
    $result = DB::transaction(function () use ($data, $service, $completionService) {

        $record = $service->save($data);

        $completion = $completionService->calculate($record);
        $record->completion_percentage = $completion;

        if ($data['form_status'] === 'completed') {
            $record->form_status = 'completed';
        }

        $record->save();

        return [
            'record'     => $record,
            'completion' => $completion,
        ];
    });

    $record     = $result['record'];
    $completion = $result['completion'];

    // 4️⃣ REPORT STATUS TO CORE PHP
    try {
        Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
            'uuid'                   => (string) $record->uuid,
            'form_name'              => 'multiple-supports',
            'completion_percentage'  => $completion,
            'form_status'            => $record->form_status,
        ]);
    } catch (\Exception $e) {
        Log::error("Error reporting Participant Signature status: " . $e->getMessage());
    }

    // ⭐ 5️⃣ AFTER TRANSACTION → PDF GENERATION & DOCUMENT UPLOAD
    if ($data['form_status'] === 'completed') {
        try {

            $pdf = Pdf::loadView('pdf.participantsignature', [
                'record'         => $record->load(['staff']),
                'signatureImage' => $record->participant_signature,
            ])->setPaper('A4', 'portrait');

            $fileName = 'Multipile_supports_' . ($record->full_name ?? 'Record') . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ⭐ SEND STAFF EMAIL to Core PHP (FINAL FIX)
            $staffEmail = $record->staff?->email ?? null;

            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';

            $response = Http::attach(
                'doc',
                file_get_contents($filePath),
                $fileName
            )->asMultipart()->post($corePhpUrl, [
                'userid'      => $record->user_id,
                'title'       => 'Multipile supports',
                'comments'    => 'Form completed successfully.',
                'companyid'   => $record->company_id ?? 1,
                // ⭐ instead of createdby → send staff_email
                'staff_email' => $staffEmail,
            ]);

            if (!$response->successful()) {
                Log::warning('⚠ PDF upload failed for Participant Signature', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }

            @unlink($filePath);

        } catch (\Exception $e) {
            Log::error('❌ PDF Generation/Upload Failed: ' . $e->getMessage());
        }
    }

    return response()->json([
        'success' => true,
        'status'  => 200,
        'message' => 'Participant Signature saved successfully.',
        'data'    => [
            'participantSignature' => $record->load('staff'),
        ],
    ]);
}



    /**
     * Show Participant Signature form by UUID
     */
    public function showByUuid(string $uuid, ParticipantSignatureCompletionService $completionService)
    {
        $record = ParticipantSignature::with('staff')
            ->where('uuid', $uuid)
            ->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Participant Signature not found',
            ], 404);
        }

        $completion = $completionService->calculate($record);
        $record->completion_percentage = $completion;

        return response()->json([
            'success' => true,
            'data' => $record,
        ]);
    }

    /**
     * Export Participant Signature form as PDF
     */
    public function exportFullFormPdf(string $uuid)
{
    $record = ParticipantSignature::with('staff')
        ->where('uuid', $uuid)
        ->firstOrFail();

    // ✅ Signature is already Base64 stored, just use it directly
    $signatureImage = $record->participant_signature ?? null;

    $pdf = Pdf::loadView('pdf.participantsignature', [
        'record' => $record,
        'signatureImage' => $signatureImage,
    ])->setPaper('A4', 'portrait');

    $fileName = 'Multipile_supports_' . ($record->staff->name ?? 'Unknown') . '.pdf';

    return $pdf->download($fileName);
}



    /**
     * Get Participant Signature UUID by user + client_type
     */
    public function getParticipantSignatureUuid(Request $request)
    {
        $userId = $request->query('userid');
        $clientType = $request->query('client_type');

        $record = ParticipantSignature::where('user_id', $userId)
            ->where('client_type', $clientType)
            ->latest()
            ->first();

        return response()->json(['uuid' => $record?->uuid ?? null]);
    }
}
