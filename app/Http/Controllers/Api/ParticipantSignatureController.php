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

        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use ($data, $service, $completionService) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // ✅ Attach staff_id from logged-in user
            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            // ✅ Save main participant signature
            $record = $service->save($data);

            // ✅ Calculate completion
            $completion = $completionService->calculate($record);
            $record->completion_percentage = $completion;

            // ✅ Update form status if final
            if ($data['form_status'] === 'completed') {
                $record->form_status = 'completed';
            }

            $record->save();

            // ✅ Report status to Core PHP system
            try {
                Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                    'uuid' => (string) $record->uuid,
                    'form_name' => 'multiple-supports',
                    'completion_percentage' => $completion,
                    'form_status' => $data['form_status'],
                ]);
            } catch (\Exception $e) {
                Log::error('Error reporting Participant Signature status: ' . $e->getMessage());
            }

            return [
                'participantSignature' => $record->load('staff'),
            ];
        });

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Participant Signature saved successfully.',
            'data' => $result,
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

    $fileName = 'Participant_Signature_' . ($record->staff->name ?? 'Unknown') . '.pdf';

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
