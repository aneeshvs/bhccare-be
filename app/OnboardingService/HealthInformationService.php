<?php

namespace App\OnboardingService;

use App\Models\HealthInformation;
use Illuminate\Support\Facades\Auth;

class HealthInformationService
{
    public function save(array $data): HealthInformation
    {
        $health = HealthInformation::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $health->fill([
            'health_conditions' => $data['health_conditions'] ?? [],
            'health_other_description' => $data['health_other_description'] ?? null,
        ]);

        if ($health->isDirty()) {
            $changes = $health->getDirty();
            $original = array_intersect_key($health->getOriginal(), $changes);

            $health->save();

            activity()
                ->useLog('health_information')
                ->performedOn($health)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $health->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('HealthInformation record has been updated');
        } else {
            $health->save(); // Save in case it's new
        }

        return $health;
    }
}
