<?php

namespace App\Services;

use App\Models\SelectedService;
use Illuminate\Support\Str;

class SelectedServiceService
{
    public function saveMany(array $services, int $clientId): array
    {
        $saved = [];

        foreach ($services as $row) {

            $serviceName = trim($row['service_name'] ?? '');

            // Skip empty service names
            if ($serviceName === '') {
                continue;
            }

            // Auto-generate goal_key if missing
            if (empty($row['goal_key'])) {
                $row['goal_key'] = 'service_' . Str::uuid();
            }

            // Find or create by client + goal_key
            $service = SelectedService::firstOrNew([
                'client_id'   => $clientId,
                'goal_key' => $row['goal_key'],
            ]);

            // Fill fields
            $service->service_name = $serviceName;
           

            // Save (no logs)
            $service->save();

            $saved[] = $service;
        }

        return $saved;
    }
}
