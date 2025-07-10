<?php
namespace App\OnboardingService;

use App\Models\EmergencyContact;

class EmergencyContactService
{

    public function save(array $data): EmergencyContact
    {
        return EmergencyContact::updateOrCreate(
            ['initial_enquiry_id' => $data['initial_enquiry_id']],
            $data
        );

    }
}
