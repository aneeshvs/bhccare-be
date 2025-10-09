<?php

namespace App\HomeSafetyChecklistAssessmentService;

use App\Models\HallwaysSafetyCheck;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HallwaysSafetyCheckService
{
    public function save(array $data): HallwaysSafetyCheck
    {
        $conditions = [
            'home_safety_checklist_assessment_id' => $data['home_safety_checklist_assessment_id'],
        ];

        $record = HallwaysSafetyCheck::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('HallwaysSafetyCheck Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('hallways_safety_check')
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
                ->log('Hallways Safety Check updated');

            $record->save();
        }

        return $record;
    }
}
