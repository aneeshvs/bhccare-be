<?php
namespace App\Services;

use App\Models\IndependentLivingOption;

class IndependentLivingOptionService
{
    public function save(array $data): IndependentLivingOption
    {
        return IndependentLivingOption::create([
            'client_id'            => $data['client_id'],
            'rent_per_week'        => $data['rent_per_week'] ?? null,
            'utilities_per_week'   => $data['utilities_per_week'] ?? null,
            'needs_furnished'      => $data['needs_furnished'] ?? false,
            'owns_furniture'       => $data['owns_furniture'] ?? false,
            'lease_duration'       => $data['lease_duration'] ?? null,
            'can_pay_bond_upfront' => $data['can_pay_bond_upfront'] ?? false,
            'preferred_location'   => $data['preferred_location'] ?? null,
            'living_preference'    => $data['living_preference'] ?? null,
        ]);
    }
}
