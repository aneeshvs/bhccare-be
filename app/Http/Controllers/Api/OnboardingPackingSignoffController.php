<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingPackingSignoffRequest;
use App\Models\OnboardingPackingSignoff;
use App\OnboardingPackingSignoffService\OnboardingPackingSignoffService;
use App\OnboardingPackingSignoffService\OnboardingPackingSignoffCompletionService;
use App\OnboardingPackingSignoffService\OnboardingPackingSignoffDisabilityActDiscussionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class OnboardingPackingSignoffController extends Controller
{
    public function update(StoreOnboardingPackingSignoffRequest $request, OnboardingPackingSignoffService $service,
    OnboardingPackingSignoffCompletionService $completionService,
    OnboardingPackingSignoffDisabilityActDiscussionService $DisabilityActDiscussionService)
    {
        $data = $request->validated();
        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use ($data, $service,$completionService,$DisabilityActDiscussionService) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            $record = $service->save($data);

            $data['onboarding_packing_signoff_id'] = $record->id;

            $DisabilityActDiscussionService->save($data);


           $completion = $completionService->calculate($record);
            $record->completion_percentage = $completion;



            if ($data['form_status'] === 'completed') {
                $record->form_status = 'completed';
            }
            $record->save();

            try {
                Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                    'uuid' => (string) $record->uuid,
                    'form_name' => 'onboarding-packing-signoff',
                    'completion_percentage' => $record->completion,
                    'form_status' => $data['form_status'],
                ]);
            } catch (\Exception $e) {
                Log::error('Error reporting Onboarding Packing Signoff status: ' . $e->getMessage());
            }

            return ['onboardingPackingSignoff' => $record->load('staff','disabilityActDiscussion')];
        });

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
        $record = OnboardingPackingSignoff::with('staff','disabilityActDiscussion')
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
            'data' => [
                'onboarding_packing_signoff' => $record,
                'completion_percentage' => $completionPercentage,
            ],
        ]);
    }



        public function exportFullFormPdf(string $uuid)
    {
        $record = OnboardingPackingSignoff::with('staff','disabilityActDiscussion')->where('uuid', $uuid)->firstOrFail();

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
