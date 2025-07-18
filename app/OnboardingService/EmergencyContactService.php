<?php

namespace App\OnboardingService;

use App\Models\EmergencyContact;
use Illuminate\Support\Facades\Auth;

class EmergencyContactService
{
    public function save(array $data): EmergencyContact
    {
        // Get or create
        $contact = EmergencyContact::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $contact->fill($data);

        if ($contact->isDirty()) {
            $changes = $contact->getDirty();
            $original = array_intersect_key($contact->getOriginal(), $changes);

            $contact->save(); // Save first before logging (in case timestamps change)

            activity()
                ->useLog('emergency_contact')
                ->performedOn($contact)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $contact->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null, // ✅ Required for PDF
                    'uuid' => $data['uuid'] ?? null        // ✅ Required for PDF
                ])
                ->log('EmergencyContact record has been updated');
        } else {
            $contact->save(); // Still save to persist record
        }

        return $contact;
    }
}
