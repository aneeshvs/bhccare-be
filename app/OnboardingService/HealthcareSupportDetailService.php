<?php
namespace App\OnboardingService;

use App\Models\HealthcareSupportDetail;

class HealthcareSupportDetailService
{
    public function save(array $data): HealthcareSupportDetail
    {
        return HealthcareSupportDetail::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            $data
        );
    }
}
