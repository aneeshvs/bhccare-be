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
    /**
     * Renew PDF for a given form and UUID.
     *
     * This supports admin (no password) and staff (password required),
     * regenerates the PDF from its view, saves it under /storage/app/public/renewed-pdfs/,
     * and returns a public URL for access.
     */
    public function renewPdf(Request $request, $form, $uuid)
    {
        try {
        if (!$request->boolean('is_admin')) {
            // ✅ Step 1: Validate user email
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $user = User::where('email', $request->email)->firstOrFail();

            // ✅ Step 2: If not admin, verify password

                $request->validate([
                    'staff_password' => 'required|string',
                ]);

                if (!Hash::check($request->staff_password, $user->password)) {
                    return response()->json(['error' => 'Invalid staff password'], 403);
                }
            }

            // ✅ Step 3: Map all supported forms
            $formMap = [
                'onboarding'          => [\App\Models\InitialEnquiry::class, 'pdf.onboarding_full_form', 'initial'],
                'support-plan'        => [\App\Models\SupportPlan::class, 'pdf.supportplan', 'supportPlan'],
                'support-care-plan'   => [\App\Models\SupportCarePlan::class, 'pdf.supportcareplan', 'supportCarePlan'],
                'service-agreement'   => [\App\Models\ServiceAgreement::class, 'pdf.serviceagreement', 'serviceAgreement'],
                'risk-assessment'     => [\App\Models\IndividualRiskAssessment::class, 'pdf.individual_risk_assessment', 'assessment'],
                'schedule-of-support' => [\App\Models\ScheduleOfSupport::class, 'pdf.schedule_of_support', 'schedule'],
                'home-safety'         => [\App\Models\HomeSafetyChecklistAssessment::class, 'pdf.home_safety_assessment', 'assessment'],
                'confidential-information'         => [\App\Models\ConfidentialInformationForm::class, 'pdf.confidentialinformationform', 'form'],
            ];

            if (!isset($formMap[$form])) {
                return response()->json(['error' => 'Unsupported form type'], 400);
            }

            // ✅ Step 4: Generate the PDF from view + model
            [$modelClass, $view, $varName] = $formMap[$form];
            $record = $modelClass::where('uuid', $uuid)->first();

            if (!$record) {
                return response()->json(['error' => 'Record not found for this UUID'], 404);
            }

            $pdf = Pdf::loadView($view, [$varName => $record]);

            // ✅ Step 5: Ensure storage directory exists
            $dir = storage_path('app/public/renewed-pdfs');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            // ✅ Step 6: Save with timestamp to avoid overwriting
            $fileName = "renewed_{$form}_{$uuid}_" . time() . ".pdf";
            $filePath = "{$dir}/{$fileName}";
            $pdf->save($filePath);

            // ✅ Step 7: Make public URL (after `php artisan storage:link`)
            $publicUrl = url("storage/renewed-pdfs/{$fileName}");

            // ✅ Step 8: Return JSON response
            return response()->json([
                'success'   => true,
                'message'   => "PDF renewed successfully for {$form}.",
                'file_name' => $fileName,
                'file_url'  => $publicUrl,
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
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
