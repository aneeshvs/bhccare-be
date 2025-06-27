<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\FullFormController;
use App\Http\Controllers\Api\LeadController;

use App\Http\Controllers\{

    UsersController,
    ProfileController,
};

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {

  Route::get('/profile', [ProfileController::class, 'show']);
  Route::post('/lead/create', [LeadController::class, 'store']);
  Route::get('/admin/lead/{uuid}/details', [LeadController::class, 'showFullDetails']);
});
Route::get('/lead/{uuid}', [LeadController::class, 'show']);
Route::put('/form/submit/{uuid}', [FullFormController::class, 'update']);


Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);

