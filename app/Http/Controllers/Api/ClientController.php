<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends UniversalController
{

public function storeBasic(Request $request)
{
    $validator = Validator::make($request->all(), [
        'uuid'                => 'nullable|string|uuid',
        'full_name'           => 'nullable|string',
        'date_of_birth'       => 'nullable|date',
        'gender'              => 'nullable|in:Male,Female,Other',
        'residential_address' => 'nullable|string',
        'mobile'              => 'nullable|string',
        'email'               => 'nullable|email',
        'password'            => 'nullable',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    $validated = $validator->validated();

    DB::beginTransaction();

    try {
        // 1️⃣ Create User
        $user = User::create([
            'name'      => $validated['full_name'] ?? 'Client',
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'user_type_id' => 4, // Client user type
        ]);

        // 2️⃣ Create Client
        $clientData = $validated;
        $clientData['prospect_uuid'] = $validated['uuid'] ?? null;
        $clientData['user_id'] = $user->id;
         

          unset($validated['uuid']);
        // unset($clientData['uuid'], $clientData['email'], $clientData['password']);

        $client = Client::create($clientData);

        DB::commit();

        return response()->json([
            'status'    => true,
            'client_id' => $client->id,
            'user_id'   => $user->id,
            'message'   => 'Client and user created successfully',
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status'  => false,
            'message' => 'Something went wrong',
            'error'   => $e->getMessage(),
        ], 500);
    }
}



}
