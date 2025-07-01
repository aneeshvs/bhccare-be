<?php
namespace App\Services;

use App\Models\Client;

class ClientService
{
        public function save(array $data): Client
    {
        return Client::updateOrCreate(
            // Lookup key — find by prospect_uuid
            ['prospect_uuid' => $data['uuid'] ?? null],

            // Values to update/create
            [
                'full_name'             => $data['full_name'],
                'date_of_birth'         => $data['date_of_birth'],
                'gender'                => $data['gender'],
                'residential_address'   => $data['residential_address'] ?? null,
                'contact_type'          => $data['contact_type'] ?? null,
                'mobile'                => $data['mobile'] ?? null,
                'email'                 => $data['email'] ?? null,
                'password'              => $data['password'] ?? null,
                'atsi_status'           => $data['atsi_status'],
                'cultural_background'   => $data['cultural_background'] ?? null,
                'language_spoken'       => $data['language_spoken'] ?? null,
                'interpreter_required'  => $data['interpreter_required'] ?? false,
                'guardian_name'         => $data['guardian_name'] ?? null,
                'is_public_guardian'    => $data['is_public_guardian'] ?? null,
                'guardian_relationship' => $data['guardian_relationship'] ?? null,
                'guardian_mobile'       => $data['guardian_mobile'] ?? null,
                'guardian_email'        => $data['guardian_email'] ?? null,
                'guardian_address'      => $data['guardian_address'] ?? null,
                'guardian_contact_method'=> $data['guardian_contact_method'] ?? null,
            ]
        );
    }

}
