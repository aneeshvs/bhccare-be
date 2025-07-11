<?php
// app/OnboardingService/SupportInformationService.php

namespace App\OnboardingService;

use App\Models\SupportInformation;

class SupportInformationService
{
    public function save(array $data): SupportInformation
    {
        return SupportInformation::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            $data
        );
    }
}
