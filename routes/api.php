<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FullFormController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


// Public Routes
Route::put('/form/submit/{uuid}', [FullFormController::class, 'update']);
Route::get('/form/data/{uuid}', [FullFormController::class, 'show']); // optional
Route::post('/generate-form-uuid', function () {
    $uuid = Str::uuid();
    $otp = Str::upper(Str::random(8)); // Alphanumeric OTP (e.g., "A7X9K2")

    return response()->json([
        'uuid' => $uuid,
        'otp'  => $otp,
    ]);
});

Route::post('/clients/create-basic', [ClientController::class, 'storeBasic']);





Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);

// Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
});
