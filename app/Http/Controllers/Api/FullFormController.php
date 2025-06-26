<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFullFormRequest;
use App\Services\ReferralService;
use App\Services\ClientService;
use App\Services\AccommodationService;
use App\Services\PreviousServiceProviderService;
use App\Services\SelectedServiceService;
use App\Services\ClientNdisDetailService;
use App\Services\HousingHistoryService;
use App\Services\MedicalInformationService;
use App\Services\RosterOfCareService;
use Illuminate\Support\Facades\DB;

class FullFormController extends UniversalController
{
    public function store(
        StoreFullFormRequest $request,
        ReferralService $referralService,
        ClientService $clientService,
        AccommodationService $accommodationService,
        PreviousServiceProviderService $providerService,
        SelectedServiceService $selectedServiceService,
        ClientNdisDetailService $clientNdisDetailService,
        MedicalInformationService $medicalInformationService,
        HousingHistoryService $housingHistoryService,
        RosterOfCareService $rosterOfCareService
    ) {
        // retrieve only validated data
        $data = $request->validated();

        // wrap all saves in a transaction
        $result = DB::transaction(function () use ($data, $referralService, $clientService, $accommodationService,$providerService,$selectedServiceService,$clientNdisDetailService,
         $medicalInformationService,$housingHistoryService,$rosterOfCareService) {
            $accommodation = $accommodationService->save($data);
            $client        = $clientService->save($data);
            $referral      = $referralService->save($data);
            $providers     = $providerService->saveMany($data['previous_service_providers'] ?? []);
            $services      = $selectedServiceService->saveMany($data['selected_services'] ?? []);
            $ndisDetail    = $clientNdisDetailService->save($data);
            $medicalDetail = $medicalInformationService->save($data);
            $housingDetail = $housingHistoryService->save($data);
            $rosterDetail  = $rosterOfCareService->save($data);


            return compact('accommodation', 'client', 'referral','providers','services','ndisDetail','medicalDetail',
            'housingDetail','rosterDetail');
        });

        return response()->json([
            'status'  => true,
            'message' => 'All records saved successfully',
            'data'    => $result,
        ], 201);
    }
}

