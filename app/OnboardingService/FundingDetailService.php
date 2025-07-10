<?php
namespace App\OnboardingService;

use App\Models\FundingDetail;

class FundingDetailService
{
    public function save(array $data): FundingDetail
    {
        return FundingDetail::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            $data
        );

    }
}
