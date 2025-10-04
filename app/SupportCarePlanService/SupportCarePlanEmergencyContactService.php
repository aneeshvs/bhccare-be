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
            // Skip empty rows
                $allEmpty = true;
                foreach ($contact as $value) {
                    if (!empty($value)) {
                        $allEmpty = false;
                        break;
                    }
                }
                if ($allEmpty) {
                    continue; // skip row if truly empty
                }


            // Ensure goal_key exists
            if (empty($contact['goal_key'])) {
                $contact['goal_key'] = 'goal_' . Str::uuid();
            }

            $record = null;

            // 1️⃣ Update by ID if present
            if (!empty($contact['id'])) {
                $record = SupportCarePlanEmergencyContact::where('id', $contact['id'])
                    ->where('support_care_plan_id', $supportCarePlanId)
                    ->first();
            }

            // 2️⃣ Update by goal_key if ID not found
            if (!$record && !empty($contact['goal_key'])) {
                $record = SupportCarePlanEmergencyContact::where('support_care_plan_id', $supportCarePlanId)
                    ->where('goal_key', $contact['goal_key'])
                    ->first();
            }

            // 3️⃣ Create new if still not found
            if (!$record) {
                $record = new SupportCarePlanEmergencyContact();
                $record->support_care_plan_id = $supportCarePlanId;
                $record->goal_key = $contact['goal_key'];
            }

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($contact);
            $record->support_care_plan_id = $supportCarePlanId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("EmergencyContact: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => optional($record->supportCarePlan)->uuid,
                ]);

                activity()
                    ->useLog('support_care_plan_emergency_contacts')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'support_care_plan_id' => $record->support_care_plan_id,
                        'uuid' => $contact['uuid'] ?? optional($record->supportCarePlan)->uuid,
                        'user_id' => $contact['user_id'] ?? optional($record->supportCarePlan)->user_id,
                        'client_type' => $contact['client_type'] ?? optional($record->supportCarePlan)->client_type,
                        'staff_id' => $contact['staff_id'] ?? optional($record->supportCarePlan)->staff_id,
                        'category' => $contact['category'] ?? 'emergency_contact',
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
