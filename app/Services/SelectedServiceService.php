<?php
namespace App\Services;

use App\Models\SelectedService;

class SelectedServiceService
{
    public function saveMany(array $services, int $clientId): array
    {
        $saved = [];

        foreach ($services as $service) {
            $saved[] = SelectedService::create([
                'client_id'    => $clientId,
                'service_name' => $service['service_name'],
            ]);
        }

        return $saved;
    }
}
