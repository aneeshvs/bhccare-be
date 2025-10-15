<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConfidentialInformationFormRequest;
use App\Models\ConfidentialInformationForm;
use App\ConfidentialInformationFormService\ConfidentialInformationFormCompletionService;
use App\ConfidentialInformationFormService\ConfidentialInformationFormService;
use App\ConfidentialInformationFormService\ConfidentialInformationAgencyService;
use App\ConfidentialInformationFormService\ConfidentialInformationConsentService;
use App\ConfidentialInformationFormService\ConfidentialVerbalConsentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConfidentialInformationFormController extends Controller
{
    /**
     * Store or update Confidential Information Form.
     */
    public function update(
        StoreConfidentialInformationFormRequest $request,
        ConfidentialInformationFormService $service,
        ConfidentialInformationFormCompletionService $completionService,
        ConfidentialInformationAgencyService  $ConfidentialInformationAgencyService,
        ConfidentialInformationConsentService $confidentialInformationConsentService,
        ConfidentialVerbalConsentService $confidentialVerbalConsentService,

    ) {
        $data = $request->validated();

        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use (
            $data,
            $service,
            $completionService,
            $ConfidentialInformationAgencyService,
            $confidentialInformationConsentService,
            $confidentialVerbalConsentService,
        ) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // ✅ Attach staff ID
            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            // ✅ Save or update form
            $form = $service->save($data);


             $data['confidential_information_form_id'] = $form->id;

             $ConfidentialInformationAgencyService->saveMany($data['agencies'] ?? [], $form->id);
              $confidentialInformationConsentService->save($data);
              $confidentialVerbalConsentService->save($data);


            // ✅ Calculate completion (optional logic)
            $completion = $completionService->calculate($form);
            $form->completion_percentage = $completion;

            // ✅ Update form status
            if ($data['form_status'] === 'completed') {
                $form->form_status = 'completed';
            }

            $form->save();

            // ✅ Report status to external PHP service (optional)
            try {
                Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                    'uuid' => (string) $form->uuid,
                    'form_name' => 'confidential-information',
                    'completion_percentage' => $completion,
                    'form_status' => $data['form_status'],
                ]);
            } catch (\Exception $e) {
                Log::error('Error reporting Confidential Information form status: ' . $e->getMessage());
            }

            return [
                'confidentialInformationForm' => $form->load([
                    'agencies','consent','verbal'

                ]),
            ];

        });

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Confidential Information Form saved successfully.',
            'data' => $result,
        ]);
    }

    /**
     * Show Confidential Information Form by UUID.
     */
    public function showByUuid(string $uuid, ConfidentialInformationFormCompletionService $completionService)
    {
        $form = ConfidentialInformationForm::with(['staff','agencies','consent','verbal'])
            ->where('uuid', $uuid)
            ->first();

        if (!$form) {
            return response()->json([
                'success' => false,
                'message' => 'Confidential Information Form not found',
            ], 404);
        }

        // Optional: Calculate completion percentage again
        $completion = $completionService->calculate($form);
        $form->completion_percentage = $completion;

        return response()->json([
            'success' => true,
            'data' => $form,
        ]);
    }

    /**
     * Export Confidential Information Form as PDF.
     */
    public function exportFullFormPdf(string $uuid)
    {
        $form = ConfidentialInformationForm::with(['staff','agencies','consent','verbal'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.confidentialinformationform', compact('form'))
            ->setPaper('A4', 'portrait');

        $fileName = 'Confidential_Information_Form_' . ($form->staff->name ?? 'Unknown') . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * Get Confidential Information Form UUID by user + client_type.
     */
    public function getConfidentialFormUuid(Request $request)
    {
        $userId = $request->query('userid');
        $clientType = $request->query('client_type');

        $form = ConfidentialInformationForm::where('user_id', $userId)
            ->where('client_type', $clientType)
            ->latest()
            ->first();

        return response()->json(['uuid' => $form?->uuid ?? null]);
    }




    public function removeSectionConfidentialForm(Request $request)
{
    $uuid  = $request->input('uuid');
    $table = $request->input('table'); // e.g., 'confidential_contacts'
    $field = $request->input('field'); // e.g., 'contact_name'
    $value = $request->input('value'); // e.g., 'John Smith'

    if (!$uuid || !$table || !$field || !$value) {
        return response()->json([
            'status' => false,
            'message' => 'uuid, table, field, and value are required.',
        ], 400);
    }

    $form = \App\Models\ConfidentialInformationForm::where('uuid', $uuid)->first();

    if (!$form) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID. No Confidential Information Form found.',
        ], 404);
    }

    // Map allowed dynamic tables to their models
    $modelMap = [

    ];

    if (!array_key_exists($table, $modelMap)) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid table name provided.',
        ], 400);
    }

    $modelClass = $modelMap[$table];

    // Locate the record tied to the form via foreign key
    $record = $modelClass::where('confidential_information_form_id', $form->id)
        ->where($field, $value)
        ->first();

    if (!$record) {
        return response()->json([
            'status' => false,
            'message' => 'Record not found for deletion.',
        ], 404);
    }

    $oldData = $record->getOriginal();
    $record->delete();

    // Log the deletion
    activity()
        ->useLog($table)
        ->performedOn($record)
        ->causedBy(Auth::user())
        ->withProperties([
            'attributes' => [$field => $value],
            'old' => $oldData,
            'confidential_information_form_id' => $form->id,
            'uuid' => $uuid,
            'user_id' => $form->user_id,
            'client_type' => $form->client_type,
            'staff_id' => $form->staff_id,
        ])
        ->log(ucwords(str_replace('_', ' ', $table)) . ' record deleted');

    return response()->json([
        'status' => true,
        'message' => 'Record removed successfully.',
    ]);
}

}
