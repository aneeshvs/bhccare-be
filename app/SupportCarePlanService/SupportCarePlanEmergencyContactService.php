<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlanEmergencyContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SupportCarePlanEmergencyContactService
{
    /**
     * Save multiple emergency contacts for a Support Care Plan
     */
    public function saveMany(array $contacts, int $supportCarePlanId): array
    {
        $saved = [];
        $processedIds = [];

        foreach ($contacts as $contact) {
            if (empty($contact['name']) && empty($contact['phone'])) {
                continue; // skip empty rows
            }

            $record = null;

            // Update if ID present
            if (!empty($contact['id'])) {
                $record = SupportCarePlanEmergencyContact::where('id', $contact['id'])
                    ->where('support_care_plan_id', $supportCarePlanId)
                    ->first();
            }

            // Create new if not found
            if (!$record) {
                $record = new SupportCarePlanEmergencyContact();
                $record->support_care_plan_id = $supportCarePlanId;
            }

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($contact);
            $record->support_care_plan_id = $supportCarePlanId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("EmergencyContact changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                ]);

                activity()
                    ->useLog('support_care_plan_emergency_contacts')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'support_care_plan_id' => $record->support_care_plan_id,
                    ])
                    ->log('Emergency Contact record updated');
            } else {
                $record->save();
            }

            $saved[] = $record;
            $processedIds[] = $record->id;
        }

        return $saved;
    }
}
