<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleOfSupportRequest;
use App\ScheduleOfSupportService\ScheduleOfSupportService;
use App\ScheduleOfSupportService\ScheduleOfSupportsCompletionService;
use App\Models\ScheduleOfSupport;
use App\ScheduleOfSupportService\AgreementSignatureService;
use App\ScheduleOfSupportService\FundedSupportService;
use App\ScheduleOfSupportService\UnfundedSupportService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ScheduleOfSupportController extends Controller
{
    public function update(StoreScheduleOfSupportRequest $request, ScheduleOfSupportService $service,
    FundedSupportService $fundedSupportService,
     UnfundedSupportService  $unfundedSupportService,AgreementSignatureService  $agreementSignatureService, ScheduleOfSupportsCompletionService $completionService)
    {
        $data = $request->validated();
        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use ($data, $service,$fundedSupportService,$unfundedSupportService,$agreementSignatureService,$completionService) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            $schedule = $service->save($data);

            $data['schedule_of_support_id'] = $schedule->id;

            $fundedSupportService->save($data);
            $unfundedSupportService->save($data);
            $agreementSignatureService->save($data);

            // ✅ Calculate completion
            $completion = $completionService->calculate($schedule);
            $schedule->completion_percentage = $completion;


            $formStatus = $data['form_status'] ?? 'in_progress';

            // Report back to Core PHP
            try {
                    Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                        'uuid' => (string) $schedule->uuid,
                        'form_name' => 'schedule_of_support',
                        'completion_percentage' => $completion,
                        'form_status' => $formStatus,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error reporting Schedule of Support status: ' . $e->getMessage());
                }

            return ['scheduleOfSupport' => $schedule->load([
                'transport',
                'unfundedSupport',
                'agreementSignature',

            ]),
        ];

        });

        return response()->json([
            'success' => true,
            'message' => 'Schedule of Support saved successfully.',
            'data' => $result,
        ]);
    }

    public function showByUuid(string $uuid, ScheduleOfSupportsCompletionService $completionService)
{
     $schedule = ScheduleOfSupport::with('transport','unfundedSupport','agreementSignature')->where('uuid', $uuid)->firstOrFail();


    if (!$schedule) {
        return response()->json([
            'success' => false,
            'message' => 'Schedule of Supports not found',
        ], 404);
    }

    // Calculate completion percentage
    $completion = $completionService->calculate($schedule);
    $schedule->completion_percentage = $completion;

    return response()->json([
        'success' => true,
        'data' => $schedule->toArray(),
    ]);
}


    public function exportFullFormPdf(string $uuid)
    {
        $schedule = ScheduleOfSupport::with('staff','transport','unfundedSupport','agreementSignature')->where('uuid', $uuid)->firstOrFail();

        $pdf = Pdf::loadView('pdf.schedule_of_support', compact('schedule'))
            ->setPaper('A4', 'portrait');

        $fileName = 'Schedule_of_Support_' . ($schedule->staff->name ?? 'Unknown') . '.pdf';

        return $pdf->download($fileName);
    }

    public function getScheduleOfSupportsUuid(Request $request)
{
    $userId = $request->query('userid');
    $clientType = $request->query('client_type');

    $schedule = \App\Models\ScheduleOfSupport::where('user_id', $userId)
        ->where('client_type', $clientType)
        ->latest()
        ->first();

    return response()->json([
        'uuid' => $schedule?->uuid
    ], 200);
}

}
