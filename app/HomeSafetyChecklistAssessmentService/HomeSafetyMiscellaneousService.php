<?php

namespace App\HomeSafetyChecklistAssessmentService;

use App\Models\HomeSafetyMiscellaneous;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeSafetyMiscellaneousService
{
    public function save(array $data): HomeSafetyMiscellaneous
    {
        $conditions = [
            'home_safety_checklist_assessment_id' => $data['home_safety_checklist_assessment_id'],
        ];

        $record = HomeSafetyMiscellaneous::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('HomeSafetyMiscellaneous Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('home_safety_miscellaneous')
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
                ->log('Home Safety Miscellaneous updated');

            $record->save();
        }

        return $record;
    }
}
