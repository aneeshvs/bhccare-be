<?php
namespace App\Services;

use App\Models\RosterOfCare;

class RosterOfCareService
{
    public function save(array $data): RosterOfCare
    {
        return RosterOfCare::create([
            'need_bhc_community_support' => $data['need_bhc_community_support'] ?? null,
            'comments' => $data['comments'] ?? null,
            'transport_funding' => $data['transport_funding'] ?? null,
        ]);
    }
}
