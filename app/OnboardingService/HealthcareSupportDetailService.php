<?php

namespace App\OnboardingService;

use App\Models\HealthcareSupportDetail;
use Illuminate\Support\Facades\Auth;

class HealthcareSupportDetailService
{
    public function save(array $data): HealthcareSupportDetail
    {
        $healthcare = HealthcareSupportDetail::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $healthcare->fill($data);

        if ($healthcare->isDirty()) {
            $changes = $healthcare->getDirty();
            $original = array_intersect_key($healthcare->getOriginal(), $changes);

            $healthcare->save();

            activity()
                ->useLog('healthcare_support_detail')
                ->performedOn($healthcare)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $healthcare->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('HealthcareSupportDetail record has been updated');
        } else {
            $healthcare->save(); // Save even if no changes to ensure record exists
        }

        return $healthcare;
    }
}
