<?php
namespace App\Services;

use App\Models\HousingHistory;

class HousingHistoryService
{
    public function save(array $data): HousingHistory
    {
        // Ensure client_id is present
        $clientId = $data['client_id'];

        // Update if exists, or create if not
        return HousingHistory::updateOrCreate(
            ['client_id' => $clientId],
            $data
        );
    }
}
