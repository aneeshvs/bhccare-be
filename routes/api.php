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

//Onboarding
// routes/api.php
Route::post('/sync-staff', [StaffSyncController::class, 'store']);
Route::post('/staff-update-password', [StaffSyncController::class, 'updatePassword']);

Route::get('/form-data/{uuid}', [OnboardingController::class, 'show']);//downoad pdf show

Route::get('/get-client-uuid', [OnboardingController::class, 'getUuid']);
Route::get('/onboarding/export-pdf/{uuid}', [OnboardingController::class, 'exportFullFormPdf']);


Route::get('/activity-logs', [ActivityLogController::class, 'index']); //activity log
Route::get('/logs/pdf', [ActivityLogController::class, 'exportLogsPdf']);

Route::get('/logs/view', [ActivityLogController::class, 'getLogsByUuid']);//pass next js


Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);

// Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/onboardsubmit',[OnboardingController::class,'update']);

});
