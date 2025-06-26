<?php
// app/Services/HousingHistoryService.php

namespace App\Services;

use App\Models\HousingHistory;

class HousingHistoryService
{
    public function save(array $data): HousingHistory
    {
        return HousingHistory::create($data);
    }
}
