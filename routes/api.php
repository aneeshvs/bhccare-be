<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FullFormController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OnboardingController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\StaffSyncController;
use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\ScheduleOfCareController;
use App\Http\Controllers\Api\SupportPlanController;
use App\Http\Controllers\Api\ServiceAgreementController;
use App\Http\Controllers\Api\SupportCarePlanController;
use App\Http\Controllers\Api\IndividualRiskAssessmentController;
use App\Http\Controllers\FormRenewController;
use App\Http\Controllers\Api\ScheduleOfSupportController;
use App\Http\Controllers\Api\HomeSafetyChecklistAssessmentController;
use App\Http\Controllers\Api\ConfidentialInformationFormController;
use App\Http\Controllers\Api\ParticipantSignatureController;

use App\Http\Controllers\Api\OnboardingPackingSignoffController;

use App\Http\Controllers\ChargebandController;




use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


// Public Routes Prospects
Route::put('/form/submit/{uuid}', [FullFormController::class, 'update']);
Route::get('/form/data/{uuid}', [FullFormController::class, 'show']);
 // optional
Route::post('/generate-form-uuid', function () {
    $uuid = Str::uuid();
    $otp = Str::upper(Str::random(8)); // Alphanumeric OTP (e.g., "A7X9K2")

    return response()->json([
        'uuid' => $uuid,
        'otp'  => $otp,
    ]);
});

Route::post('/clients/create-basic', [ClientController::class, 'storeBasic']); //core php create propect api call

Route::get('/validate-password', [FullFormController::class, 'validatePassword']);//prospect_form validate

Route::delete('/full-form/remove-item', [FullFormController::class, 'removeItem']);// delete prospect

//Onboarding
// routes/api.php
Route::post('/sync-staff', [StaffSyncController::class, 'store']);
Route::post('/staff-update-password', [StaffSyncController::class, 'updatePassword']);

Route::get('/form-data/{uuid}', [OnboardingController::class, 'show']);//downoad pdf show

Route::get('/get-client-uuid', [OnboardingController::class, 'getUuid']);
Route::get('/onboarding/export-pdf/{uuid}', [OnboardingController::class, 'exportFullFormPdf']);

// Route::post('/onboarding/renew-pdf/{uuid}', [OnboardingController::class, 'renewPdf']);


Route::get('/activity-logs', [ActivityLogController::class, 'index']); //activity log
Route::get('/logs/pdf', [ActivityLogController::class, 'exportLogsPdf']);

Route::get('/logs/view', [ActivityLogController::class, 'getLogsByUuid']);//pass next js

Route::delete('/schedule-of-care/remove', [ScheduleOfCareController::class, 'remove']);// delete specific table
Route::delete('/form/section/remove', [OnboardingController::class, 'removeSection']); // delete common for all table


Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::apiResource('chargebands', ChargebandController::class);

// routes/api.php support plan
Route::get('/support-plan-show/{uuid}', [SupportPlanController::class, 'showByUuid']);
Route::get('/support-plan/export-pdf/{uuid}', [SupportPlanController::class, 'exportFullFormPdf']);
// In api.php
Route::get('/get-support-plan-uuid', [SupportPlanController::class, 'getSupportPlanUuid']);
Route::get('/logs/view/support', [ActivityLogController::class, 'getLogsByUuidSupport']);

//remove support plan
Route::delete('/formsupport/section/remove', [SupportPlanController::class, 'removeSection']);




//service agreement

// First static route
Route::get('/service-agreement/logs', [ActivityLogController::class, 'getLogsByUuidServiceAgreement']);

// Then dynamic route
Route::get('/service-agreement/{uuid}', [ServiceAgreementController::class, 'showByUuid']);

Route::get('/get-service-agreement-uuid', [ServiceAgreementController::class, 'getServiceAgreementUuid']);

Route::get('/service-agreement/export-pdf/{uuid}', [ServiceAgreementController::class, 'exportFullFormPdf']);
Route::get('/service-agreement/{uuid}/export-pdf', [ServiceAgreementController::class, 'exportFullFormPdf']);


// 🔹 Static first (logs)
Route::get('/support-care-plan/logs', [ActivityLogController::class, 'getLogsByUuidSupportCarePlan']);

// 🔹 Fetch by UUID (public)
Route::get('/support-care-plan/{uuid}', [SupportCarePlanController::class, 'showByUuid']);

// 🔹 Get UUID by user & client_type
Route::get('/get-support-care-plan-uuid', [SupportCarePlanController::class, 'getSupportCarePlanUuid']);

// 🔹 Export PDF (two options)
Route::get('/support-care-plan/export-pdf/{uuid}', [SupportCarePlanController::class, 'exportFullFormPdf']);
Route::get('/support-care-plan/{uuid}/export-pdf', [SupportCarePlanController::class, 'exportFullFormPdf']);



Route::delete('/supportcareplan/remove-section', [SupportCarePlanController::class, 'removeSectionSupportCarePlan']);

// risk assessment

Route::get('/risk-assessment/logs', [ActivityLogController::class, 'getLogsByUuidRiskAssessment']);

// 🔹 Fetch by UUID (public)
Route::get('/risk-assessment/{uuid}', [IndividualRiskAssessmentController::class, 'showByUuid']);

// 🔹 Get UUID by user & client_type
Route::get('/get-risk-assessment-uuid', [IndividualRiskAssessmentController::class, 'getRiskAssessmentUuid']);

// 🔹 Export PDF (two options)
Route::get('/risk-assessment/export-pdf/{uuid}', [IndividualRiskAssessmentController::class, 'exportFullFormPdf']);
Route::get('/risk-assessment/{uuid}/export-pdf', [IndividualRiskAssessmentController::class, 'exportFullFormPdf']);

Route::delete('/risk-assessment/remove-section', [IndividualRiskAssessmentController::class, 'removeSectionRiskAssessment']);


Route::get('/schedule-of-supports/logs', [ActivityLogController::class, 'getLogsByUuidSchedule']); // Logs by UUID

Route::get('/schedule-of-supports/{uuid}', [ScheduleOfSupportController::class, 'showByUuid']); // Fetch by UUID

Route::get('/get-schedule-of-supports-uuid', [ScheduleOfSupportController::class, 'getScheduleOfSupportsUuid']); // Get UUID by user & client_type

Route::get('/schedule-of-supports/export-pdf/{uuid}', [ScheduleOfSupportController::class, 'exportFullFormPdf']); // Export PDF
Route::get('/schedule-of-supports/{uuid}/export-pdf', [ScheduleOfSupportController::class, 'exportFullFormPdf']); // Export PDF alternate

Route::delete('/schedule-of-support/section/remove', [ScheduleOfSupportController::class, 'removeSection']);



Route::get('/home-safety-assessment/logs', [ActivityLogController::class, 'getLogsByUuidHomeSafety']); // Logs by UUID

// ✅ Public (no auth required)
Route::get('/get-home-safety-assessment-uuid', [HomeSafetyChecklistAssessmentController::class, 'getHomeSafetyAssessmentUuid']); // Get UUID by user_id & client_type

Route::get('/home-safety-assessment/{uuid}', [HomeSafetyChecklistAssessmentController::class, 'showByUuid']); // Fetch Home Safety by UUID


Route::get('/home-safety-assessment/export-pdf/{uuid}', [HomeSafetyChecklistAssessmentController::class, 'exportFullFormPdf']); // Export PDF

Route::get('/home-safety-assessment/{uuid}/export-pdf', [HomeSafetyChecklistAssessmentController::class, 'exportFullFormPdf']); // Alternate PDF route



Route::get('/confidential-form/logs', [ActivityLogController::class, 'getLogsByUuidConfidential']); // Activity logs by UUID

// ✅ Public (no auth required)
Route::get('/get-confidential-form-uuid', [ConfidentialInformationFormController::class, 'getConfidentialFormUuid']);
// Get UUID by user_id & client_type
Route::get('/confidential-form/{uuid}', [ConfidentialInformationFormController::class, 'showByUuid']); // View by UUID

Route::get('/confidential-form/export-pdf/{uuid}', [ConfidentialInformationFormController::class, 'exportFullFormPdf']); // Export PDF


Route::delete('/confidential-form/remove-section', [ConfidentialInformationFormController::class, 'removeSectionConfidentialForm']);



// ✅ Activity Logs for Participant Signature
Route::get('/multiple-supports/logs', [ActivityLogController::class, 'getLogsByUuidParticipantSignature']); // Activity logs by UUID

// ✅ Public (no auth required)
Route::get('/get-multiple-supports-uuid', [ParticipantSignatureController::class, 'getParticipantSignatureUuid']); // Get UUID by user_id & client_type
Route::get('/multiple-supports/{uuid}', [ParticipantSignatureController::class, 'showByUuid']); // View by UUID
Route::get('/multiple-supports/export-pdf/{uuid}', [ParticipantSignatureController::class, 'exportFullFormPdf']); // Export PDF


Route::get('/onboarding-packing-signoff/logs', [ActivityLogController::class, 'getLogsByUuidOnboardingPackingSignoff']);

// ✅ Public (no auth)
Route::get('/get-onboarding-packing-signoff-uuid', [OnboardingPackingSignoffController::class, 'getUuid']);
Route::get('/onboarding-packing-signoff/{uuid}', [OnboardingPackingSignoffController::class, 'showByUuid']);
Route::get('/onboarding-packing-signoff/export-pdf/{uuid}', [OnboardingPackingSignoffController::class, 'exportFullFormPdf']);





Route::post('/form/{form}/renew-pdf/{uuid}', [FormRenewController::class, 'renewPdf']);



//publi api routes

Route::put('/client/onboarding-packing-signoff/update', [OnboardingPackingSignoffController::class, 'clientSignatureUpdate']);



// Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/onboardsubmit',[OnboardingController::class,'update']);
    Route::put('/support-plan', [SupportPlanController::class, 'update']);
    Route::put('/service-agreement/update', [ServiceAgreementController::class, 'update']);
     // Support Care Plan
    Route::put('/support-care-plan/update', [SupportCarePlanController::class, 'update']);

    Route::put('/risk-assessment/update', [IndividualRiskAssessmentController::class, 'update']);

    Route::put('/schedule-of-support/update', [ScheduleOfSupportController::class, 'update']);

     Route::put('/home-safety-assessment/update', [HomeSafetyChecklistAssessmentController::class, 'update']);

     Route::put('/confidential-form/update', [ConfidentialInformationFormController::class, 'update']);

    Route::put('/multiple-supports/update', [ParticipantSignatureController::class, 'update']);

     Route::put('/onboarding-packing-signoff/update', [OnboardingPackingSignoffController::class, 'update']);



});

