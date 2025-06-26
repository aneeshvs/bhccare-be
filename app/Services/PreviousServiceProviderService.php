<?php
namespace App\Services;

use App\Models\PreviousServiceProvider;

class PreviousServiceProviderService
{
    public function saveMany(array $providers, int $clientId): array
    {
        $saved = [];

        foreach ($providers as $provider) {
            $saved[] = PreviousServiceProvider::create([
                'client_id'          => $clientId,
                'provider'           => $provider['provider'] ?? null,
                'contact_details'    => $provider['contact_details'] ?? null,
                'length_of_support'  => $provider['length_of_support'] ?? null,
                'reason_for_leaving' => $provider['reason_for_leaving'] ?? null,
            ]);
        }

        return $saved;
    }
}
