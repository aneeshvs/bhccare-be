<?php

namespace App\Services;

use App\Models\PreviousServiceProvider;
use Illuminate\Support\Str;

class PreviousServiceProviderService
{
    public function saveMany(array $providers, int $clientId): array
    {
        $saved = [];

        foreach ($providers as $row) {

            $providerName = trim($row['provider'] ?? '');

            // Skip empty provider
            if ($providerName === '') {
                continue;
            }

            // Auto-generate goal_key if missing
            if (empty($row['goal_key'])) {
                $row['goal_key'] = 'provider_' . Str::uuid();
            }

            // Find or create by client + goal_key
            $provider = PreviousServiceProvider::firstOrNew([
                'client_id'    => $clientId,
                'goal_key' => $row['goal_key'],
            ]);

            // Fill fields
            $provider->provider           = $providerName;
            $provider->contact_details    = $row['contact_details'] ?? null;
            $provider->length_of_support  = $row['length_of_support'] ?? null;
            $provider->reason_for_leaving = $row['reason_for_leaving'] ?? null;

            // Save (no logs)
            $provider->save();

            $saved[] = $provider;
        }

        return $saved;
    }
}
