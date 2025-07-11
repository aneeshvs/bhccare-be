<?php
namespace App\OnboardingService;

use App\Models\BehaviourSupport;

class BehaviourSupportService
{
    public function save(array $data): BehaviourSupport
    {
        return BehaviourSupport::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            [
                'has_support_plan' => $data['has_support_plan'] ?? false,
                'plan_copy_received' => $data['plan_copy_received'] ?? false,
            ]
        );
    }
}
