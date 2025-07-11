<?php
namespace App\OnboardingService;

use App\Models\DiagnosisSummary;

class DiagnosisSummaryService
{
    public function save(array $data): DiagnosisSummary
    {
        return DiagnosisSummary::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            [
                'primary_diagnosis' => $data['primary_diagnosis'] ?? null,
                'secondary_diagnosis' => $data['secondary_diagnosis'] ?? null,
            ]
        );
    }
}
