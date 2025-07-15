<?php
namespace App\OnboardingService;

use App\Models\InitialEnquiry;

class InitialEnquiryService
{
    public function save(array $data): InitialEnquiry
    {
        // ✅ Define matching conditions (based on business logic)
        $conditions = [
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ];

        // ✅ Update or create the record
        return InitialEnquiry::updateOrCreate($conditions, $data);
    }
}
