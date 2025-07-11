<?php
namespace App\OnboardingService;

use App\Models\CulturalBackground;

class CulturalBackgroundService
{
    public function save(array $data): CulturalBackground
    {
        return CulturalBackground::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            $data
        );
    }
}
