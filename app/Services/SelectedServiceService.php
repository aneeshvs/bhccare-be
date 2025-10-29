<?php

namespace App\Services;

use App\Models\SelectedService;

class SelectedServiceService
{
    public function saveMany(array $services, int $clientId): array
    {
        $saved = [];

        foreach ($services as $service) {
            $serviceName = trim($service['service_name'] ?? '');

            // 🚫 Skip if service name is empty
            if ($serviceName === '') {
                continue;
            }

            // 🔍 Check if the same service already exists (case-insensitive)
            $existing = SelectedService::where('client_id', $clientId)
                ->whereRaw('LOWER(service_name) = ?', [strtolower($serviceName)])
                ->first();

            if ($existing) {
                // ✅ If there are additional fields, compare & update
                $changes = [
                    'description' => $service['description'] ?? null, // example field
                    'category'    => $service['category'] ?? null,    // example field
                ];

                // Filter only changed fields
                $dirty = array_filter($changes, fn($v, $k) => $existing->$k !== $v, ARRAY_FILTER_USE_BOTH);

                if (!empty($dirty)) {
                    $existing->update($changes);
                }

                $saved[] = $existing;
            } else {
                // 🆕 Create new record
                $saved[] = SelectedService::create([
                    'client_id'    => $clientId,
                    'service_name' => $serviceName,
                    'description'  => $service['description'] ?? null,
                    'category'     => $service['category'] ?? null,
                ]);
            }
        }

        return $saved;
    }
}
