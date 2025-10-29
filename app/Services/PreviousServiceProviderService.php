<?php

namespace App\Services;

use App\Models\PreviousServiceProvider;

class PreviousServiceProviderService
{
    public function saveMany(array $providers, int $clientId): array
    {
        $saved = [];

        foreach ($providers as $provider) {
            $providerName = trim($provider['provider'] ?? '');

            // 🚫 Skip if provider name is empty
            if ($providerName === '') {
                continue;
            }

            // 🔍 Check for existing record (case-insensitive match)
            $existing = PreviousServiceProvider::where('client_id', $clientId)
                ->whereRaw('LOWER(provider) = ?', [strtolower($providerName)])
                ->first();

            if ($existing) {
                // ✅ Update only if any field has changed
                $changes = [
                    'contact_details'    => $provider['contact_details'] ?? null,
                    'length_of_support'  => $provider['length_of_support'] ?? null,
                    'reason_for_leaving' => $provider['reason_for_leaving'] ?? null,
                ];

                // Only update if something is different
                $dirty = array_filter($changes, fn($v, $k) => $existing->$k !== $v, ARRAY_FILTER_USE_BOTH);

                if (!empty($dirty)) {
                    $existing->update($changes);
                }

                $saved[] = $existing;
            } else {
                // 🆕 Create a new provider record
                $saved[] = PreviousServiceProvider::create([
                    'client_id'          => $clientId,
                    'provider'           => $providerName,
                    'contact_details'    => $provider['contact_details'] ?? null,
                    'length_of_support'  => $provider['length_of_support'] ?? null,
                    'reason_for_leaving' => $provider['reason_for_leaving'] ?? null,
                ]);
            }
        }

        return $saved;
    }
}
