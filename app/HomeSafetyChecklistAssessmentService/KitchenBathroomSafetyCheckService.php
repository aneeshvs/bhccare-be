<?php

namespace App\HomeSafetyChecklistAssessmentService;

use App\Models\KitchenBathroomSafetyCheck;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KitchenBathroomSafetyCheckService
{
    public function save(array $data): KitchenBathroomSafetyCheck
    {
        $conditions = [
            'home_safety_checklist_assessment_id' => $data['home_safety_checklist_assessment_id'],
        ];

        $record = KitchenBathroomSafetyCheck::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('KitchenBathroomSafetyCheck Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('kitchen_bathroom_safety_check')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $record->uuid ?? null,
                    'home_safety_checklist_assessment_id' => $record->home_safety_checklist_assessment_id,
                ])
                ->log('Kitchen / Bathroom Safety Check updated');

            $record->save();
        }

        return $record;
    }
}
