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

Route::post('/onboarding/renew-pdf/{uuid}', [OnboardingController::class, 'renewPdf']);


Route::get('/activity-logs', [ActivityLogController::class, 'index']); //activity log
Route::get('/logs/pdf', [ActivityLogController::class, 'exportLogsPdf']);

Route::get('/logs/view', [ActivityLogController::class, 'getLogsByUuid']);//pass next js

Route::delete('/schedule-of-care/remove', [ScheduleOfCareController::class, 'remove']);// delete specific table
Route::delete('/form/section/remove', [OnboardingController::class, 'removeSection']); // delete common for all table


Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);

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



// Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/onboardsubmit',[OnboardingController::class,'update']);
    Route::put('/support-plan', [SupportPlanController::class, 'update']);
    Route::put('/service-agreement/update', [ServiceAgreementController::class, 'update']);
     // Support Care Plan
    Route::put('/support-care-plan/update', [SupportCarePlanController::class, 'update']);


});

