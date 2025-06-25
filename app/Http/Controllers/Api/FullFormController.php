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
    ) {
        // retrieve only validated data
        $data = $request->validated();

        // wrap all saves in a transaction
        $result = DB::transaction(function () use ($data, $referralService, $clientService, $accommodationService,$providerService,$selectedServiceService) {
            $accommodation = $accommodationService->save($data);
            $client        = $clientService->save($data);
            $referral      = $referralService->save($data);
            $providers = $providerService->saveMany($data['previous_service_providers'] ?? []);
          $services = $selectedServiceService->saveMany($data['selected_services'] ?? []);

            return compact('accommodation', 'client', 'referral','providers','services');
        });

        return response()->json([
            'status'  => true,
            'message' => 'All records saved successfully',
            'data'    => $result,
        ], 201);
    }
}
