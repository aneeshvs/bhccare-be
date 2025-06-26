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
use App\Models\Lead;
use App\Services\NdisGoalService;
use Illuminate\Support\Facades\DB;

class FullFormController extends UniversalController
{


public function update(
    StoreFullFormRequest $request,
    ReferralService $referralService,
    ClientService $clientService,
    AccommodationService $accommodationService,
    PreviousServiceProviderService $providerService,
    SelectedServiceService $selectedServiceService,
    ClientNdisDetailService $clientNdisDetailService,
    MedicalInformationService $medicalInformationService,
    HousingHistoryService $housingHistoryService,
    RosterOfCareService $rosterOfCareService,
    NdisGoalService $ndisGoalService,
    string $uuid
) {
    $lead = Lead::where('uuid', $uuid)->firstOrFail();
    $data = $request->validated();
    $data['lead_id'] = $lead->id;
    $data['email']    = $lead->email;


    $result = DB::transaction(function () use (
        $data,
        $lead,
        $referralService,
        $clientService,
        $accommodationService,
        $providerService,
        $selectedServiceService,
        $clientNdisDetailService,
        $medicalInformationService,
        $housingHistoryService,
        $rosterOfCareService,
        $ndisGoalService,
    ) {
        $client = $clientService->save($data);
        $data['client_id'] = $client->id;

        // Save other records with client_id
        $referral = $referralService->save($data);
        $accommodation = $accommodationService->save($data);
        $providerService->saveMany($data['previous_service_providers'] ?? [], $client->id);
        $selectedServiceService->saveMany($data['selected_services'] ?? [], $client->id);

        $clientNdisDetailService->save($data);
        $medicalInformationService->save($data);
        $housingHistoryService->save($data);
        $rosterOfCareService->save($data);
        $ndisGoalService->saveMany($data['ndis_goals'] ?? [], $client->id);


        // ✅ Mark lead as converted
        $lead->update(['status' => 'completed']);

        return compact('client');
    });

    return response()->json([
        'status' => true,
        'message' => 'Form submitted and client created successfully.',
        'data' => $result,
    ]);
}

}

