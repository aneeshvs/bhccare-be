<?php
// app/OnboardingService/HealthProfessionalDetailService.php

namespace App\OnboardingService;

use App\Models\HealthProfessionalDetail;

class HealthProfessionalDetailService
{
    public function saveMany(array $items, int $initialEnquiryId): array
    {
        $results = [];

        foreach ($items as $item) {
            $item['initial_enquiry_id'] = $initialEnquiryId;
            $results[] = HealthProfessionalDetail::create($item);
        }

        return $results;
    }
}
