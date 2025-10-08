<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class FormRenewController extends Controller
{
    public function renewPdf(Request $request, $form, $uuid)
{
    $request->validate([
        'staff_password' => 'required|string',
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->email)->firstOrFail();
    if (!Hash::check($request->staff_password, $user->password)) {
        return response()->json(['error' => 'Invalid staff password'], 403);
    }

    $formMap = [
    'onboarding'         => [\App\Models\InitialEnquiry::class, 'pdf.onboarding_full_form', 'initial'],
    'support-plan'       => [\App\Models\SupportPlan::class, 'pdf.supportplan', 'supportPlan'],
    'support-care-plan'  => [\App\Models\SupportCarePlan::class, 'pdf.supportcareplan', 'supportCarePlan'],
    'service-agreement'  => [\App\Models\ServiceAgreement::class, 'pdf.serviceagreement', 'serviceAgreement'],
    'risk-assessment'    => [\App\Models\IndividualRiskAssessment::class, 'pdf.individual_risk_assessment', 'assessment'],
    'schedule-of-support' => [\App\Models\ScheduleOfSupport::class, 'pdf.schedule_of_support', 'schedule'],
    'home-safety' => [\App\Models\HomeSafetyChecklistAssessment::class, 'pdf.home_safety_assessment', 'homeSafety'], // ✅ added // ✅ added
];


    if (!isset($formMap[$form])) {
        return response()->json(['error' => 'Unsupported form type'], 400);
    }

    [$modelClass, $view, $varName] = $formMap[$form];
    $record = $modelClass::where('uuid', $uuid)->firstOrFail();

    $pdf = Pdf::loadView($view, [$varName => $record]);

    $dir = storage_path("app/renewed-pdfs");
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }

    $fileName = "renewed_{$form}_{$uuid}_" . time() . ".pdf";
    $filePath = "{$dir}/{$fileName}";

    $pdf->save($filePath);

    return response()->json([
        'message'   => 'PDF generated and stored successfully.',
        'file_name' => $fileName,
        'file_url'  => url("storage/renewed-pdfs/{$fileName}") // accessible if storage:link done
    ]);
}

}

