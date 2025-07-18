<?php

namespace App\OnboardingService;

use App\Models\SupportInformation;
use Illuminate\Support\Facades\Auth;

class SupportInformationService
{
    public function save(array $data): SupportInformation
    {
        $support = SupportInformation::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $support->fill($data);

        if ($support->isDirty()) {
            $changes = $support->getDirty();
            $original = array_intersect_key($support->getOriginal(), $changes);

            $support->save();

            activity()
                ->useLog('support_information')
                ->performedOn($support)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $support->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('SupportInformation record has been updated');
        } else {
            $support->save(); // Save to insert if new
        }

        return $support;
    }
}
