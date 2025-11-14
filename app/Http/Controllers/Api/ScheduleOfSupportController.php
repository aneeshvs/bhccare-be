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

            $fundedSupportService->saveMany($data['funded_supports'] ?? [], $schedule->id);
            $unfundedSupportService->saveMany($data['unfunded_supports'] ?? [], $schedule->id);
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

public function removeSection(Request $request)
{
    $uuid   = $request->input('uuid');
    $table  = $request->input('table');   // funded_supports / unfunded_supports
    $field  = $request->input('field');   // e.g. support_name
    $value  = $request->input('value');   // e.g. Community Participation

    if (!$uuid || !$table || !$field || !$value) {
        return response()->json([
            'status' => false,
            'message' => 'uuid, table, field, and value are required.',
        ], 400);
    }

    // Find Schedule by UUID
    $schedule = ScheduleOfSupport::where('uuid', $uuid)->first();
    if (!$schedule) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID.',
        ], 404);
    }

    // Map tables to models
    $modelMap = [
        'funded_supports'   => \App\Models\FundedSupport::class,
        'unfunded_supports' => \App\Models\UnfundedSupport::class,
    ];

    if (!isset($modelMap[$table])) {
        return response()->json([
            'status' => false,
            'message' => 'Unsupported table.',
        ], 400);
    }

    $modelClass = $modelMap[$table];

    // Find the record
    $record = $modelClass::where('schedule_of_support_id', $schedule->id)
        ->where($field, $value)
        ->first();

    if (!$record) {
        return response()->json([
            'status' => false,
            'message' => 'Record not found.',
        ], 404);
    }

    // Log old data
    $original = $record->getOriginal();

    // Delete
    $record->delete();

    // Activity Log
    activity()
        ->useLog($table)
        ->performedOn($record)
        ->causedBy(Auth::user())
        ->withProperties([
            'attributes' => [$field => $value],
            'old' => $original,
            'schedule_of_support_id' => $schedule->id,
            'uuid' => $uuid,
            'client_type' => $schedule->client_type,
            'staff_id' => $schedule->staff_id,
            'user_id' => $schedule->user_id,
        ])
        ->log(ucwords(str_replace('_', ' ', $table)) . ' entry deleted');

    return response()->json([
        'status' => true,
        'message' => 'Entry removed successfully.',
    ]);
}


}
