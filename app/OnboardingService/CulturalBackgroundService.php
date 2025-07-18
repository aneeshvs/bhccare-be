<?php

namespace App\OnboardingService;

use App\Models\CulturalBackground;
use Illuminate\Support\Facades\Auth;

class CulturalBackgroundService
{
    public function save(array $data): CulturalBackground
    {
        $cultural = CulturalBackground::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $cultural->fill($data);

        if ($cultural->isDirty()) {
            $changes = $cultural->getDirty();
            $original = array_intersect_key($cultural->getOriginal(), $changes);

            $cultural->save();

            activity()
                ->useLog('cultural_background')
                ->performedOn($cultural)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $cultural->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                     'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('CulturalBackground record has been updated');
        } else {
            $cultural->save();
        }

        return $cultural;
    }
}
