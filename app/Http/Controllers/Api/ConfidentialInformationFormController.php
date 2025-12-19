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
use App\ConfidentialInformationFormService\PreConsentDisclosureService;
use App\Models\PreConsentDisclosure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;


use App\Models\ConfidentialInformationConsent;
use App\Models\ConfidentialVerbalConsent;

use Illuminate\Support\Facades\Validator;

class ConfidentialInformationFormController extends Controller
{
    /**
     * Store or update Confidential Information Form.
     */
public function update(
    StoreConfidentialInformationFormRequest $request,
    ConfidentialInformationFormService $service,
    ConfidentialInformationFormCompletionService $completionService,
    ConfidentialInformationAgencyService $ConfidentialInformationAgencyService,
    ConfidentialInformationConsentService $confidentialInformationConsentService,
    ConfidentialVerbalConsentService $confidentialVerbalConsentService,
    PreConsentDisclosureService $preConsentDisclosureService
) {
    $data = $request->validated();

    // ⭐ Determine form status
    $isFinal = $request->boolean('submit_final');
    $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

    // ⭐ DB Transaction
    $form = DB::transaction(function () use (
        $data,
        $service,
        $completionService,
        $ConfidentialInformationAgencyService,
        $confidentialInformationConsentService,
        $confidentialVerbalConsentService,
        $preConsentDisclosureService
    ) {

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // ⭐ Attach staff_id
        $staff = \App\Models\Staff::where('user_id', $user->id)->first();
        $data['staff_id'] = $staff?->id ?? null;

        // ⭐ Save Base Form
        $form = $service->save($data);

        $data['confidential_information_form_id'] = $form->id;

        // ⭐ Save related sections
        $ConfidentialInformationAgencyService->saveMany($data['agencies'] ?? [], $form->id);
        $confidentialInformationConsentService->save($data);
        $confidentialVerbalConsentService->save($data);
        $preConsentDisclosureService->save($data);

        // ⭐ Calculate completion %
        $completion = $completionService->calculate($form);
        $form->completion_percentage = $completion;

        if ($data['form_status'] === 'completed') {
            $form->form_status = 'completed';
        }

        $form->save();

        // ⭐ Report to Core PHP
        try {
            Http::asForm()->post(config('services.core_php.base_url') . '/update-form-status.php', [
                'uuid' => (string) $form->uuid,
                'form_name' => 'confidential-information',
                'completion_percentage' => $completion,
                'form_status' => $data['form_status'],
            ]);
        } catch (\Exception $e) {
            Log::error('⚠ Error calling Core PHP update-form-status: ' . $e->getMessage());
        }
         return $form;

    });

    // ⭐ After transaction → Generate & Send PDF
    if ($data['form_status'] === 'completed') {

        try {
            // ⭐ Generate PDF
            $pdf = Pdf::loadView('pdf.confidentialinformationform', [
                'form' => $form->load([
                    'agencies',
                    'consent',
                    'verbal',
                    'preConsentDisclosure'
                ])
            ])->setPaper('A4', 'portrait');

            $fileName = 'Confidential_Information_' . $form->full_name . '.pdf';
            $filePath = storage_path("app/temp/{$fileName}");
            $pdf->save($filePath);

            // ⭐ Push PDF to Core PHP user_documents
            $corePhpUrl = config('services.core_php.base_url') . '/add-user-document.php';
            $staffEmail = $form->staff?->email ?? null;

            $response = Http::attach(
                'doc',
                file_get_contents($filePath),
                $fileName
            )->asMultipart()->post($corePhpUrl, [
                'userid'    => $form->user_id,
                'title'     => 'Confidential Information',
                'comments'  => 'Form completed successfully.',
                'companyid' => $form->company_id ?? 1,
                'staff_email' => $staffEmail,
            ]);

            if ($response->successful()) {
                Log::info('📄 PDF synced successfully for Confidential Information');
            } else {
                Log::warning('⚠ Failed PDF sync for Confidential Information', [
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
        'message' => 'Confidential Information Form saved successfully.',
        'data' => [
        'confidentialInformationForm' => $form->load([
            'agencies',
            'consent',
            'verbal',
            'preConsentDisclosure'
        ])
    ],


    ]);
}


/**
     * CLIENT: Signature update for Confidential Information Form (public)
     * Updates both ConfidentialInformationConsent and ConfidentialVerbalConsent
     */
    public function clientSignatureUpdate(Request $request)
    {
        Log::info('📝 Confidential Form Client signature submission started', $request->all());
        
        // Validate signature fields
        $validator = Validator::make($request->all(), [
            'uuid' => 'required|string',
            'user_id' => 'required|integer',
            // Consent 1 fields (ConfidentialInformationConsent)
            'signature_consent' => 'required|string',
            'signed_date_consent' => 'nullable|date',
            'name_consent' => 'nullable|string|max:255',
            'signed_by_consent' => 'nullable|string|max:255',
            'witnessed_by_consent' => 'nullable|string|max:255',
            
            // Consent 2 fields (ConfidentialVerbalConsent)
            'verbal_signature' => 'required|string',
            'verbal_signed_date' => 'nullable|date',
            'verbal_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);
        
        if ($validator->fails()) {
            Log::error('❌ Validation failed', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $validated = $validator->validated();
        
        // Find the parent form
        $parentRecord = ConfidentialInformationForm::where('uuid', $validated['uuid'])
            ->where('user_id', $validated['user_id'])
            ->first();
        
        if (!$parentRecord) {
            Log::error('❌ Form not found', ['uuid' => $validated['uuid'], 'user_id' => $validated['user_id']]);
            return response()->json([
                'success' => false,
                'message' => 'Form not found'
            ], 404);
        }
        
        Log::info('✅ Found parent record', [
            'uuid' => $parentRecord->uuid,
            'parent_id' => $parentRecord->id,
        ]);
        
        // ⭐ UPDATE ConfidentialInformationConsent (first consent form)
        if ($request->hasAny(['signature_consent', 'signed_date_consent', 'name_consent', 'signed_by_consent', 'witnessed_by_consent'])) {
            $consent1 = ConfidentialInformationConsent::updateOrCreate(
                [
                    'confidential_information_form_id' => $parentRecord->id
                ],
                [
                    'signature' => $validated['signature_consent'] ?? null,
                    'signed_date' => $validated['signed_date_consent'] ?? null,
                    'name' => $validated['name_consent'] ?? null,
                    'signed_by' => $validated['signed_by_consent'] ?? null,
                    'witnessed_by' => $validated['witnessed_by_consent'] ?? null,
                ]
            );
            
            Log::info('✅ ConfidentialInformationConsent saved', [
                'consent_id' => $consent1->id,
                'has_signature' => !empty($validated['signature_consent']),
            ]);
        }
        
        // ⭐ UPDATE ConfidentialVerbalConsent (second consent form)
        if ($request->hasAny(['verbal_signature', 'verbal_signed_date', 'verbal_name', 'position'])) {
            $consent2 = ConfidentialVerbalConsent::updateOrCreate(
                [
                    'confidential_information_form_id' => $parentRecord->id
                ],
                [
                    'verbal_signature' => $validated['verbal_signature'] ?? null,
                    'verbal_signed_date' => $validated['verbal_signed_date'] ?? null,
                    'verbal_name' => $validated['verbal_name'] ?? null,
                    'position' => $validated['position'] ?? null,
                ]
            );
            
            Log::info('✅ ConfidentialVerbalConsent saved', [
                'verbal_consent_id' => $consent2->id,
                'has_verbal_signature' => !empty($validated['verbal_signature']),
            ]);
        }
        
        // Load the updated relationships
        $parentRecord->load(['consent', 'verbal']);
        
        return response()->json([
            'success' => true,
            'message' => 'Signature(s) submitted successfully',
            'data' => [
                'uuid' => $parentRecord->uuid,
                'consent' => $parentRecord->consent ? [
                    'signature' => $parentRecord->consent->signature,
                    'signed_date' => $parentRecord->consent->signed_date,
                    'name' => $parentRecord->consent->name,
                ] : null,
                'verbal' => $parentRecord->verbal ? [
                    'verbal_signature' => $parentRecord->verbal->verbal_signature,
                    'verbal_signed_date' => $parentRecord->verbal->verbal_signed_date,
                    'verbal_name' => $parentRecord->verbal->verbal_name,
                ] : null,
            ]
        ]);
    }
    
   



    /**
     * Show Confidential Information Form by UUID.
     */
    public function showByUuid(string $uuid, ConfidentialInformationFormCompletionService $completionService)
    {
        $form = ConfidentialInformationForm::with(['staff','agencies','consent','verbal','preConsentDisclosure'])
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
    $form = ConfidentialInformationForm::with(['staff','agencies','consent','verbal','preConsentDisclosure'])
        ->where('uuid', $uuid)
        ->firstOrFail();

    // ✅ If signature is stored Base64 already:
    $signatureImage = $form->consent->signature ?? null;

    // If signature is stored binary:
    // $signatureImage = $form->consent->signature ? 'data:image/png;base64,' . base64_encode($form->consent->signature) : null;

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.confidentialinformationform', [
        'form' => $form,
        'signatureImage' => $signatureImage // ✅ pass to view
    ])->setPaper('A4', 'portrait');

    return $pdf->download('Confidential_Information_Form_' . ($form->staff->name ?? 'Unknown') . '.pdf');
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
         'confidential_information_agency' => \App\Models\ConfidentialInformationAgency::class,

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
