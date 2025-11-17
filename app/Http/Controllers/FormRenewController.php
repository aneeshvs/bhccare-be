<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FormRenewController extends Controller
{
    public function renewPdf(Request $request, $form, $uuid)
    {
        try {
            /**
             * ---------------------------------------------------------
             * 1) Verify staff or admin
             * ---------------------------------------------------------
             */
            if (!$request->boolean('is_admin')) {

                // Validate email
                $request->validate([
                    'email' => 'required|email|exists:users,email',
                ]);

                $user = User::where('email', $request->email)->firstOrFail();

                // Validate password
                $request->validate([
                    'staff_password' => 'required|string',
                ]);

                if (!Hash::check($request->staff_password, $user->password)) {
                    return response()->json(['error' => 'Invalid staff password'], 403);
                }
            }

            /**
             * ---------------------------------------------------------
             * 2) Supported forms
             * ---------------------------------------------------------
             */
            $formMap = [
                'onboarding'          => [\App\Models\InitialEnquiry::class, 'pdf.onboarding_full_form', 'initial'],
                'support-plan'        => [\App\Models\SupportPlan::class, 'pdf.supportplan', 'supportPlan'],
                'support-care-plan'   => [\App\Models\SupportCarePlan::class, 'pdf.supportcareplan', 'supportCarePlan'],
                'service-agreement'   => [\App\Models\ServiceAgreement::class, 'pdf.serviceagreement', 'serviceAgreement'],
                'risk-assessment'     => [\App\Models\IndividualRiskAssessment::class, 'pdf.individual_risk_assessment', 'assessment'],
                'schedule-of-support' => [\App\Models\ScheduleOfSupport::class, 'pdf.schedule_of_support', 'schedule'],
                'home-safety'         => [\App\Models\HomeSafetyChecklistAssessment::class, 'pdf.home_safety_assessment', 'assessment'],
                'confidential-information' => [\App\Models\ConfidentialInformationForm::class, 'pdf.confidentialinformationform', 'form'],

                // ✅ Participant Signature FIX HERE
                'multiple-supports' => [
                    \App\Models\ParticipantSignature::class,
                    'pdf.participantsignature',
                    'record'
                ],

                'onboarding-packing-signoff' => [
                    \App\Models\OnboardingPackingSignoff::class,
                    'pdf.onboardingpacking',
                    'record'
                ],
            ];

            if (!isset($formMap[$form])) {
                return response()->json(['error' => 'Unsupported form type'], 400);
            }

            [$modelClass, $view, $varName] = $formMap[$form];

            /**
             * ---------------------------------------------------------
             * 3) Fetch the record
             * ---------------------------------------------------------
             */
            $record = $modelClass::where('uuid', $uuid)->first();

            if (!$record) {
                return response()->json(['error' => 'Record not found for this UUID'], 404);
            }

            /**
             * ---------------------------------------------------------
             * 4) Extra PDF variables (Fix for signatureImage)
             * ---------------------------------------------------------
             */
            $extra = [];

            if ($form === 'multiple-supports') {
                // Detect signature image column (base64 or file path)
                $extra['signatureImage'] = $record->signature_image
                    ?? $record->signature
                    ?? $record->image
                    ?? null;
            }

            /**
             * ---------------------------------------------------------
             * 5) Generate PDF
             * ---------------------------------------------------------
             */
            $pdf = Pdf::loadView($view, array_merge([
                $varName => $record,
            ], $extra));

            /**
             * ---------------------------------------------------------
             * 6) Create storage directory
             * ---------------------------------------------------------
             */
            $dir = storage_path('app/public/renewed-pdfs');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            /**
             * ---------------------------------------------------------
             * 7) Save PDF with unique name
             * ---------------------------------------------------------
             */
            $fileName = "renewed_{$form}_{$uuid}_" . time() . ".pdf";
            $filePath = "{$dir}/{$fileName}";

            $pdf->save($filePath);

            /**
             * ---------------------------------------------------------
             * 8) Send PDF to Core PHP
             * ---------------------------------------------------------
             */
            $corePhpUrl = config('services.core_php.base_url') . '/save-pdf.php';

            $ch = curl_init($corePhpUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'uuid' => $uuid,
                'form' => $form,
                'pdf_file' => new \CURLFile($filePath, 'application/pdf', $fileName)
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $coreResponse = curl_exec($ch);
            curl_close($ch);

            Log::info("Core PHP upload response: {$coreResponse}");

            /**
             * ---------------------------------------------------------
             * 9) Public URL
             * ---------------------------------------------------------
             */
            $publicUrl = url("storage/renewed-pdfs/{$fileName}");

            /**
             * ---------------------------------------------------------
             * 10) Success JSON
             * ---------------------------------------------------------
             */
            return response()->json([
                'success' => true,
                'message' => "PDF renewed successfully for {$form}.",
                'file_name' => $fileName,
                'file_url' => $publicUrl,
            ]);

        } catch (\Throwable $e) {
            Log::error('FormRenewController Error: ' . $e->getMessage(), [
                'form' => $form,
                'uuid' => $uuid,
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while renewing the PDF.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
