<?php

namespace App\OnboardingService;

use App\Models\PreventiveHealthSummary;

class PreventiveHealthSummaryService
{
    public function save(array $data): PreventiveHealthSummary
    {
        return PreventiveHealthSummary::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            $data
        );
    }
}
