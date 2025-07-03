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
use App\Models\Client;
use App\Services\FinalDeclarationService;
use App\Services\IndependentLivingOptionService;
use App\Services\NdisGoalService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


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
    IndependentLivingOptionService $independentLivingOptionService,
    FinalDeclarationService $finalDeclarationService,
    string $uuid
) {


    $data = $request->validated();

    $result = DB::transaction(function () use (
        $data,
        $uuid,
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
        $independentLivingOptionService,
        $finalDeclarationService,
    ) {
        // Include uuid in client creation
        $data['uuid'] = $uuid;
        $data['form_status'] = 'completed';
        $client = $clientService->save($data);
        $data['client_id'] = $client->id;

        // Save all services
        $referralService->save($data);
        $accommodationService->save($data);
        $providerService->saveMany($data['previous_service_providers'] ?? [], $client->id);
        $selectedServiceService->saveMany($data['selected_services'] ?? [], $client->id);
        $clientNdisDetailService->save($data);
        $medicalInformationService->save($data);
        $housingHistoryService->save($data);
        $rosterOfCareService->save($data);
        $ndisGoalService->saveMany($data['ndis_goals'] ?? [], $client->id);
        $independentLivingOptionService->save($data);
        $finalDeclarationService->save($data);


        return compact('client');
    });



//core php request
$response=Http::asForm()->post('http://localhost/bhcappdemo/php/update-form-status.php', [
    'uuid' => $uuid,
    'form_status' => 'completed',
]);


Log::info('Core PHP form status response', [
    'response' => $response->body(),
    'status' => $response->status()
]);




    return response()->json([
        'status' => true,
        'message' => 'Form submitted and client created successfully.',
        'data' => $result,
    ]);
}
public function show(string $uuid)
{
    $client = Client::with([
        'referrals', 'accommodations', 'selectedServices',
        'previousServiceProviders', 'clientNdisDetail',
        'medicalInformation', 'housingHistory', 'rosterOfCare',
        'ndisGoals', 'independentLivingOption', 'finalDeclaration'
    ])->where('prospect_uuid', $uuid)->first();

    if (!$client) {
        return response()->json(['status' => false, 'message' => 'Form not found.'], 404);
    }

    return response()->json([
        'status' => true,
        'data' => $client,
    ]);
}




}

