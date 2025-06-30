<?php
namespace App\Services;

use App\Models\Accommodation;

class AccommodationService
{
    public function save(array $data): Accommodation
    {
        return Accommodation::updateOrCreate([
             'client_id'             => $data['client_id'],
            'type_of_accommodation' => $data['type_of_accommodation'],
            'requested_support'     => $data['requested_support'] ?? null,
            'worker_preference'     => $data['worker_preference'],
            'date_of_referral'      => $data['date_of_referral'],
        ]);
    }
}
