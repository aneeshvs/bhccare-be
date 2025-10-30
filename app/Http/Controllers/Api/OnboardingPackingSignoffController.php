<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingPackingSignoffRequest;
use App\Models\OnboardingPackingSignoff;
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

        $result = DB::transaction(function () use (
            $data,
            $service,
            $completionService,
            $DisabilityActDiscussionService,
            $ParticipantDeclarationService,
        ) {
            $user = Auth::user();
            if (!$user) {
                Log::warning('❌ Unauthorized access attempt to OnboardingPackingSignoffController');
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            Log::info('✅ Authenticated Staff Found', [
                'user_id' => $user->id,
                'staff_id' => $data['staff_id'],
            ]);

            // ✅ Save main record
            $record = $service->save($data);

            // ✅ Save related records
            $data['onboarding_packing_signoff_id'] = $record->id;
            $DisabilityActDiscussionService->save($data);
            $ParticipantDeclarationService->save($data);

            // ✅ Calculate completion
            $completion = $completionService->calculate($record);
            $record->completion_percentage = $completion;

            if ($data['form_status'] === 'completed') {
                $record->form_status = 'completed';
            }

            $record->save();

            Log::info('✅ OnboardingPackingSignoff saved', [
                'uuid' => $record->uuid,
                'completion_percentage' => $record->completion_percentage,
                'form_status' => $record->form_status,
            ]);

            // ✅ Send status to Core PHP system
            $payload = [
                'uuid' => (string) $record->uuid,
                'form_name' => 'onboarding-packing-signoff',
                'completion_percentage' => $record->completion_percentage, // ✅ fixed property
                'form_status' => $data['form_status'],
            ];

            Log::info('📤 Sending to Core PHP form_status_tracking', $payload);

            try {
                $response = Http::asForm()->post(
                    config('services.core_php.base_url') . '/update-form-status.php',
                    $payload
                );

                if ($response->failed()) {
                    Log::error('❌ Core PHP request failed', [
                        'response' => $response->body(),
                        'status' => $response->status(),
                    ]);
                } else {
                    Log::info('✅ Core PHP response received', [
                        'response' => $response->json(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('❌ Exception while sending to Core PHP', [
                    'error' => $e->getMessage(),
                ]);
            }

            return [
                'onboardingPackingSignoff' =>
                    $record->load('staff', 'disabilityActDiscussion', 'participantDeclaration'),
            ];
        });

        Log::info('🎉 OnboardingPackingSignoff transaction complete', [
            'result' => $result,
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Onboarding Packing Sign Off saved successfully.',
            'data' => $result,
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
