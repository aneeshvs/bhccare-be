<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingRequest;
use App\OnboardingService\InitialEnquiryService;
use App\OnboardingService\FundingDetailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class OnboardingController extends UniversalController
{
    public function store(
        StoreOnboardingRequest  $request,
        InitialEnquiryService $initialService,
        FundingDetailService $fundingDetailService
    ) {
        $data = $request->validated();

        $result = DB::transaction(function () use (
                $data,
                $initialService,
                $fundingDetailService
            ) {
                $initial = $initialService->save($data);
                $data['initial_enquiry_id'] = $initial->id;

                $funding = $fundingDetailService->save($data);

                return compact('initial', 'funding'); // ✅ returns both models
        });


        return response()->json([
            'status' => true,
            'message' => 'Form submitted and client created successfully.',
            'data' => $result, // ✅ will now return the inserted row
        ]);
    }


}







