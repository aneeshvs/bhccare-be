<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use Illuminate\Support\Facades\Log;// or your onboarding model

class OnboardingController extends Controller
{


    public function show($uuid)
{
    $token = request('token');
    $expected = hash_hmac('sha256', $uuid, env('FORM_SECRET_KEY'));
     // ✅ Add debug logs
    Log::info('Incoming UUID: ' . $uuid);
    Log::info('Expected Token: ' . $expected);
    Log::info('Received Token: ' . $token);


    if (!hash_equals($expected, $token)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $client = \App\Models\Client::where('prospect_uuid', $uuid)->first();

    if (!$client) {
        return response()->json(['message' => 'Client not found'], 404);
    }

    return response()->json(['data' => $client], 200);
}



}
