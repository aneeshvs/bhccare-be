<?php

namespace App\OnboardingService;

use App\Models\MedicalAlert;
use Illuminate\Support\Facades\Auth;

class MedicalAlertService
{
    public function save(array $data): MedicalAlert
    {
        $alert = MedicalAlert::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $alert->fill($data);

        if ($alert->isDirty()) {
            $changes = $alert->getDirty();
            $original = array_intersect_key($alert->getOriginal(), $changes);

            $alert->save();

            activity()
                ->useLog('medical_alert')
                ->performedOn($alert)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('MedicalAlert record has been updated');
        } else {
            $alert->save(); // ensure it's saved at least once
        }

        return $alert;
    }
}
