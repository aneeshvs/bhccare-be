<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends UniversalController
{


    public function login(LoginRequest $request)
{
    try {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] = $auth->name;
            $success['user'] = $auth;
            return $this->sendResponse($success, "Login Successfully");
        } else {
            return $this->sendError('Unauthorized');
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'Login error: ' . $e->getMessage()], 500);
    }
}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->legacyIndex(
            User::model(),
            UserResource::class
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        return parent::legacyStore(
            $request,
            User::model(),
            UserResource::class,
            User::connectionName()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return parent::legacyShow($user, UserResource::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        return $this->legacyUpdate($request,
            $user,
            UserResource::class,
            User::connectionName()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return parent::legacyDelete($user);
    }
}
