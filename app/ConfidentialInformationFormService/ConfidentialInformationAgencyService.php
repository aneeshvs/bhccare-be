<?php

namespace App\ConfidentialInformationFormService;

use App\Models\ConfidentialInformationAgency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\ConfidentialInformationForm;

class ConfidentialInformationAgencyService
{
    /**
     * Save multiple agency records for a Confidential Information Form.
     *
     * @param array $agencies
     * @param int $formId
     * @return array
     */
    public function saveMany(array $agencies, int $formId): array
    {
        $saved = [];
        $processedIds = [];

        foreach ($agencies as $agency) {
            // 1️⃣ Skip truly empty rows
            $allEmpty = true;
            foreach ($agency as $value) {
                if (!empty($value)) {
                    $allEmpty = false;
                    break;
                }
            }
            if ($allEmpty) {
                continue;
            }

            // 2️⃣ Ensure goal_key exists
            if (empty($agency['goal_key'])) {
                $agency['goal_key'] = 'agency_' . Str::uuid();
            }

            $record = null;

            // 3️⃣ Update by ID if present
            if (!empty($agency['id'])) {
                $record = ConfidentialInformationAgency::where('id', $agency['id'])
                    ->where('confidential_information_form_id', $formId)
                    ->first();
            }

            // 4️⃣ Update by goal_key if ID not found
            if (!$record && !empty($agency['goal_key'])) {
                $record = ConfidentialInformationAgency::where('confidential_information_form_id', $formId)
                    ->where('goal_key', $agency['goal_key'])
                    ->first();
            }

            // 5️⃣ Create new if still not found
            if (!$record) {
                $record = new ConfidentialInformationAgency();
                $record->confidential_information_form_id = $formId;
                $record->goal_key = $agency['goal_key'];
            }

            $original = $record->exists ? $record->getOriginal() : [];

            // 6️⃣ Fill and assign form ID
            $record->fill($agency);
            $record->confidential_information_form_id = $formId;

            // 7️⃣ Track and save changes
            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();
                $form = ConfidentialInformationForm::find($formId);


                Log::info("ConfidentialInformationAgency: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'goal_key' => $record->goal_key,
                ]);


                activity()
                    ->useLog('confidential_information_agency')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'confidential_information_form_id' => $record->confidential_information_form_id,

                       'staff_id' => $data['staff_id'] ?? optional($form)->staff_id,
                        'user_id' => optional($form)->user_id,
                        'client_type' => optional($form)->client_type,
                        'uuid' => $record->uuid ?? optional($form)->uuid,
                    ])

                    ->log('Confidential Information Agency record updated');
            } else {
                $record->save(); // still save if newly created
            }

            $saved[] = $record;
            $processedIds[] = $record->id;
        }

        return $saved;
    }
}
