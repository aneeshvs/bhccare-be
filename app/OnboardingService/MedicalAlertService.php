<?php
namespace App\OnboardingService;

use App\Models\MedicalAlert;

class MedicalAlertService
{
    public function save(array $data): MedicalAlert
    {
        return MedicalAlert::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            $data
        );
    }
}
