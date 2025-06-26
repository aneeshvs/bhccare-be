<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\FullFormController;
use App\Http\Controllers\{

    UsersController,
    ProfileController,
};

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {

  Route::get('/profile', [ProfileController::class, 'show']);
  Route::post('/full-form', [FullFormController::class, 'store']);
});

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'store']);

