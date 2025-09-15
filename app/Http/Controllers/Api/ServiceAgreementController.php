<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreServiceAgreementRequest;
use App\Http\Controllers\Controller;
use App\Models\ServiceAgreement;
use App\ServiceAgreementService\ServiceAgreementService;
use App\ServiceAgreementService\ServiceAgreementCompletionService;
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

    ) {
        $data = $request->validated();

        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use (
            $data,
            $service,
            $completionService,

        ) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // ✅ Attach staff
            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            // ✅ Save main agreement
            $agreement = $service->save($data);
            $data['service_agreement_id'] = $agreement->id;





            // ✅ Calculate completion
            $completion = $completionService->calculate($agreement);
            $agreement->completion_percentage = $completion;

            // ✅ Report status to Core PHP
            $formStatus = $data['form_status'] ?? 'in_progress';

            try {
                Http::asForm()->post(env('CORE_PHP_URL') . '/update-form-status.php', [
                    'uuid' => (string) $agreement->uuid,
                    'form_name' => 'service_agreement',
                    'completion_percentage' => $completion,
                    'form_status' => $formStatus,
                ]);
            } catch (\Exception $e) {
                Log::error('Error reporting service agreement form status: ' . $e->getMessage());
            }

            if ($formStatus === 'completed') {
                $agreement->form_status = 'completed';
                $agreement->save();
            }

            return [
                'serviceAgreement' => $agreement->load([

                ]),
            ];
        });

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Service Agreement saved successfully.',
            'data' => $result,
        ]);
    }




    public function showByUuid($uuid, ServiceAgreementCompletionService $completionService)
{
    // ✅ Load all related relationships if needed
    $serviceAgreement = ServiceAgreement::with([


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
    $serviceAgreement = ServiceAgreement::with(['staff']) // add other relationships if any
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
