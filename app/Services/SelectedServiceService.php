<?php
// app/Services/SelectedServiceService.php

namespace App\Services;

use App\Models\SelectedService;

class SelectedServiceService
{
    public function saveMany(array $data): array
    {
        $saved = [];

        foreach ($data as $service) {
            $saved[] = SelectedService::create([
                'service_name' => $service['service_name'],
            ]);
        }

        return $saved;
    }
}
