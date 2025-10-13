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
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
    $existingClient = Client::where('prospect_uuid', $uuid)->first();

    if ($existingClient && $existingClient->form_status === 'completed' && empty($data['submit_final'])) {
        return response()->json([
            'status' => false,
            'message' => 'Form has already been submitted and cannot be edited.',
        ], 403);
    }
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
        $data['form_status'] = isset($data['submit_final']) && $data['submit_final'] == true
        ? 'completed'
        : 'in_progress';
        unset($data['submit_final']);


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

        if ($data['form_status'] === 'completed') {
            $response =  Http::asForm()->post(config('services.core_php.base_url') . '/php/update-form-status.php', [
                'uuid' => $uuid,
                'form_status' => 'completed',
            ]);


        }
        return compact('client');
    });


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



    public function validatePassword(Request $request)
{

    $client = Client::where('prospect_uuid', $request->uuid)->first();

    if (!$client || $client->password !== $request->password) {

        return response()->json([
            'success' => false,
            'status' => false,
            'message' => 'Invalid credentials.',
        ]);
    }

    return response()->json([
        'success' => true,
        'status' => true,
        'message' => 'Password is valid.',

    ]);
}
// remove item in (savemany)
public function removeItem(Request $request)
{
    $uuid = $request->input('uuid');
    $table = $request->input('table'); // e.g., 'previous_service_providers'
    $field = $request->input('field'); // e.g., 'provider'
    $value = $request->input('value'); // e.g., 'Provider A'

    if (!$uuid || !$table || !$field || !$value) {
        return response()->json([
            'status' => false,
            'message' => 'uuid, table, field, and value are required.',
        ], 400);
    }

    $client = \App\Models\Client::where('prospect_uuid', $uuid)->first();
    if (!$client) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID. Client not found.',
        ], 404);
    }

    // Table => Model mapping
    $modelMap = [
        'previous_service_providers' => \App\Models\PreviousServiceProvider::class,
        'selected_services' => \App\Models\SelectedService::class,
        'ndis_goals' => \App\Models\NdisGoal::class,
        // Add more here as needed
    ];

    if (!array_key_exists($table, $modelMap)) {
        return response()->json([
            'status' => false,
            'message' => 'Unsupported table.',
        ], 400);
    }

    $model = $modelMap[$table];

    $deleted = $model::where('client_id', $client->id)
        ->where($field, $value)
        ->delete();

    return response()->json([
        'status' => $deleted > 0,
        'message' => $deleted > 0 ? 'Entry deleted successfully.' : 'Entry not found.',
    ]);
}





}

