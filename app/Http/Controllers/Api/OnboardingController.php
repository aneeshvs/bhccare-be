<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingRequest;
use App\OnboardingService\InitialEnquiryService;
use App\OnboardingService\FundingDetailService;
use App\OnboardingService\EmergencyContactService;
use App\OnboardingService\ScheduleOfCareService;
use App\OnboardingService\CulturalBackgroundService;
 use App\OnboardingService\NdisGoalServices;
 use App\OnboardingService\HealthProfessionalDetailService;
 use App\OnboardingService\DiagnosisSummaryService;
 use App\OnboardingService\HealthInformationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class OnboardingController extends UniversalController
{
    public function store(
        StoreOnboardingRequest  $request,
        InitialEnquiryService $initialService,
        FundingDetailService $fundingDetailService,
        EmergencyContactService $emergencyContactService,
        ScheduleOfCareService   $scheduleOfCareService,
        CulturalBackgroundService $culturalBackgroundService,
        NdisGoalServices $ndisGoalService,
        HealthProfessionalDetailService $healthProfessionalDetailService,
        DiagnosisSummaryService $diagnosisSummaryService,
        HealthInformationService $healthInformationService,

        ) {
        $data = $request->validated();

        $result = DB::transaction(function () use (
                $data,
                $initialService,
                $fundingDetailService,
                $emergencyContactService,
                $scheduleOfCareService,
                $culturalBackgroundService,
                $ndisGoalService,
                $healthProfessionalDetailService,
                $diagnosisSummaryService,
                $healthInformationService,
            ) {
                $initial = $initialService->save($data);
                $data['initial_enquiry_id'] = $initial->id;

                $funding = $fundingDetailService->save($data);
                $contacts = $emergencyContactService->save($data);
                $schedules = $scheduleOfCareService->saveMany($data['schedule_of_cares'] ?? [], $initial->id);
                $cultural = $culturalBackgroundService->save($data);
                $ndisGoalService = $ndisGoalService->saveMany($data['ndis_goals_onboarding'] ?? [], $initial->id);
                $healthProfessionals = $healthProfessionalDetailService->saveMany($data['health_professional_details'] ?? [],$initial->id);
                $diagnosis = $diagnosisSummaryService->save($data);
                $healthInfo = $healthInformationService->save($data);




                return compact('initial', 'funding','contacts','schedules','cultural','ndisGoalService','healthProfessionals','diagnosis','healthInfo'); // ✅ returns both models
        });


        return response()->json([
            'status' => true,
            'message' => 'Form submitted and client created successfully.',
            'data' => $result, // ✅ will now return the inserted row
        ]);
    }


}







