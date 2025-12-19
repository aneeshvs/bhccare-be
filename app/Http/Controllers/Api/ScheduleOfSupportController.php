<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleOfSupportRequest;
use App\ScheduleOfSupportService\ScheduleOfSupportService;
use App\ScheduleOfSupportService\ScheduleOfSupportsCompletionService;
use App\Models\ScheduleOfSupport;
use App\Models\AgreementSignature;
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
    public function update(
    StoreScheduleOfSupportRequest $request,
    ScheduleOfSupportService $service,
    FundedSupportService $fundedSupportService,
    UnfundedSupportService $unfundedSupportService,
    AgreementSignatureService $agreementSignatureService,
    ScheduleOfSupportsCompletionService $completionService
) {
    $data = $request->validated();

    // ⭐ Determine form status
    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

    // ⭐ DB Transaction
    $schedule = DB::transaction(function () use (
        $data,
        $service,
        $fundedSupportService,
        $unfundedSupportService,
        $agreementSignatureService,
        $completionService
    ) {

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $staff = \App\Models\Staff::where('user_id', $user->id)->first();
        $data['staff_id'] = $staff?->id ?? null;

        // ⭐ Save Base Form
        $schedule = $service->save($data);

        $data['schedule_of_support_id'] = $schedule->id;

        // ⭐ Save Related Sections
        $fundedSupportService->saveMany($data['funded_supports'] ?? [], $schedule->id);
        $unfundedSupportService->saveMany($data['unfunded_supports'] ?? [], $schedule->id);
        $agreementSignatureService->save($data);

        // ⭐ Calculate completion %
        $completion = $completionService->calculate($schedule);
        $schedule->completion_percentage = $completion;

        // ⭐ Report to Core PHP
        try {
            Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                'uuid' => (string) $schedule->uuid,
                'form_name' => 'schedule_of_support',
                'completion_percentage' => $completion,
                'form_status' => $data['form_status'],
            ]);
        } catch (\Exception $e) {
            Log::error('⚠ Error calling Core PHP update-form-status: '.$e->getMessage());
        }

        return $schedule;
    });

    // ⭐ After transaction → Generate & Send PDF
    if ($data['form_status'] === 'completed') {

        try {
            // ⭐ Generate PDF
            $pdf = Pdf::loadView('pdf.schedule_of_support', [
                'schedule' => $schedule->load([
                    'transport',
                    'unfundedSupport',
                    'agreementSignature',
                    'staff'
                ])
            ])->setPaper('A4', 'portrait');

            $fileName = 'Schedule_Of_Support_' . $schedule->full_name . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ⭐ Push PDF to Core PHP user_documents
            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';
            $staffEmail = $schedule->staff?->email ?? null;

            $response = Http::attach(
                'doc',
                file_get_contents($filePath),
                $fileName
            )->asMultipart()->post($corePhpUrl, [
                'userid'    => $schedule->user_id,
                'title'     => 'Schedule of Support',
                'comments'  => 'Form completed successfully.',
                'companyid' => $schedule->company_id ?? 1,
            'staff_email' => $staffEmail,
            ]);

            if ($response->successful()) {
                Log::info('📄 PDF synced successfully for Schedule of Support');
            } else {
                Log::warning('⚠ Failed PDF sync for Schedule of Support', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

            @unlink($filePath);

        } catch (\Exception $e) {
            Log::error('❌ PDF Generation/Sync Failed: ' . $e->getMessage());
        }
    }

    // ⭐ Final Response
    return response()->json([
        'success' => true,
        'status' => 200,
        'message' => 'Schedule of Support updated successfully.',
        'data' =>['scheduleOfSupport' => $schedule->load([
                    'transport',
                    'unfundedSupport',
                    'agreementSignature',
                    'staff'
                ])

        ],
    ]);
}


public function clientUpdateAllSignatures(Request $request)
{
    Log::info('📝 Client updating ALL signature fields in AgreementSignature via UUID');

    // Validate using UUID approach
    $validated = $request->validate([
        'uuid' => 'required|string',
        'user_id' => 'required|integer',
        
        // PARTICIPANT FIELDS
        'participant_signature' => 'nullable|string',
        'agreement_participant_name' => 'nullable|string|max:255',
        'participant_date' => 'nullable|date',
        
        // REPRESENTATIVE FIELDS
        'representative_signature' => 'nullable|string',
        'representative_name' => 'nullable|string|max:255',
        'representative_date' => 'nullable|date',
    ]);

    // Find the parent ScheduleOfSupport record using UUID
    $schedule = ScheduleOfSupport::where('uuid', $validated['uuid'])
        ->where('user_id', $validated['user_id'])
        ->first();

    if (!$schedule) {
        Log::warning('❌ Schedule not found or access denied', [
            'uuid' => $validated['uuid'],
            'user_id' => $validated['user_id']
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Schedule not found or access denied'
        ], 404);
    }

    // ⭐ UPDATE or CREATE the AgreementSignature record
    $agreementSignature = AgreementSignature::updateOrCreate(
        [
            'schedule_of_support_id' => $schedule->id
        ],
        [
            // Participant fields
            'participant_signature' => $validated['participant_signature'],
            'agreement_participant_name' => $validated['agreement_participant_name'],
            'participant_date' => $validated['participant_date'],
            
            // Representative fields
            'representative_signature' => $validated['representative_signature'],
            'representative_name' => $validated['representative_name'],
            'representative_date' => $validated['representative_date'],
        ]
    );

    Log::info('✅ Client updated ALL signature fields', [
        'schedule_id' => $schedule->id,
        'agreement_signature_id' => $agreementSignature->id,
        'client_id' => $validated['user_id']
    ]);

    return response()->json([
        'success' => true,
        'message' => 'All signatures have been saved',
        'data' => [
            'uuid' => $schedule->uuid,
            'participant_signature' => [
                'name' => $agreementSignature->agreement_participant_name,
                'date' => $agreementSignature->participant_date,
                'signed' => !empty($agreementSignature->participant_signature),
            ],
            'representative_signature' => [
                'name' => $agreementSignature->representative_name,
                'date' => $agreementSignature->representative_date,
                'signed' => !empty($agreementSignature->representative_signature),
            ]
        ]
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
    $schedule = ScheduleOfSupport::with(
        'staff',
        'transport',
        'unfundedSupport',
        'agreementSignature'
    )->where('uuid', $uuid)->firstOrFail();

    // Pass flag to Blade view
    $flag = $schedule->sil_section_flag;  

    $pdf = Pdf::loadView('pdf.schedule_of_support', compact('schedule', 'flag'))
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
