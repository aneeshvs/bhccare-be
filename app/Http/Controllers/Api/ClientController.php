<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends UniversalController
{

public function storeBasic(Request $request)
{
    $validator = Validator::make($request->all(), [
        'uuid'                => 'nullable|string|uuid',
        'full_name'           => 'required|string',
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
    $validated['prospect_uuid'] = $validated['uuid'];
    unset($validated['uuid']);

    $client = \App\Models\Client::create($validated);

    return response()->json([
        'status' => true,
        'client_id' => $client->id,
        'message' => 'Client basic info saved',
    ]);
}


}
