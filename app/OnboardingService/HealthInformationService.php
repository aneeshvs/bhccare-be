<?php
namespace App\OnboardingService;
use App\Models\HealthInformation;

class HealthInformationService
{
    public function save(array $data): HealthInformation
    {
        return HealthInformation::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            ['health_conditions' => $data['health_conditions'] ?? []]
        );
    }
}
