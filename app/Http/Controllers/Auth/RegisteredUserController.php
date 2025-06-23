<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
 use Illuminate\Http\JsonResponse;

class RegisteredUserController extends Controller
{


public function store(Request $request): JsonResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'user_type_id' => ['required', 'integer', 'in:2,3'], // Allow only Prompt and User
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_type_id' => $request->user_type_id,
    ]);

    event(new Registered($user));

    // Optionally create token for SPA auth if needed

    return response()->json([
        'message' => 'User registered successfully',
        'user' => $user,
    ]);
}

}
