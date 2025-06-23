<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends UniversalController
{
    // Get authenticated user profile
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    // Update authenticated user profile
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $user->update($request->only('name', 'email'));

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => $user
        ]);
    }

    // Logout user (optional if needed)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
