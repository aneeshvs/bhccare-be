<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FullFormController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


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


// Route::get('/debug-token', function (Request $request) {
//     $uuid = $request->uuid;
//     $token = hash_hmac('sha256', $uuid, env('FORM_SECRET_KEY'));
//     return response()->json([
//         'uuid' => $uuid,
//         'expected_token' => $token
//     ]);
// });


// use Illuminate\Support\Facades\Hash;

// Route::post('/token-creation', function (Request $request) {
//     $request->validate([
//         'name' => 'required|string',
//         'password' => 'required|string',
//     ]);

//     // Replace this with actual user check (e.g., from users table)
//     if ($request->name === 'admin' && $request->password === '1234') {
//         $uuid = 'f4c072a5-fbe8-4b27-99db-860377a677ff'; // example UUID
//         $secret = env('FORM_SECRET_KEY');
//         $token = hash_hmac('sha256', $uuid, $secret);

//         return response()->json([
//             'token' => $token,
//             'uuid' => $uuid,
//             'url' => url("/api/onboarding/show/$uuid?token=$token"),
//         ]);
//     }

//     return response()->json(['message' => 'Invalid credentials'], 401);
// });



Route::prefix('onboarding')->group(function () {
    Route::get('/show/{uuid}', [\App\Http\Controllers\Api\OnboardingController::class, 'show']);
    Route::post('/submit/{uuid}', [\App\Http\Controllers\Api\OnboardingController::class, 'submit']);
});

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);

// Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
});
