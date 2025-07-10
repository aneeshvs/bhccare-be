<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingRequest;
use App\OnboardingService\InitialEnquiryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class OnboardingController extends UniversalController
{
    public function store(
        StoreOnboardingRequest  $request,
        InitialEnquiryService $initialService
    ) {
        $data = $request->validated();

        $result = DB::transaction(function () use (
            $data,
            $initialService
        ) {
            return $initialService->save($data); // ✅ important: return the created record
        });

        return response()->json([
            'status' => true,
            'message' => 'Form submitted and client created successfully.',
            'data' => $result, // ✅ will now return the inserted row
        ]);
    }


}







