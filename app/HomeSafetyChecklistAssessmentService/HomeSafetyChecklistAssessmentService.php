<?php

namespace App\HomeSafetyChecklistAssessmentService;

use App\Models\HomeSafetyChecklistAssessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeSafetyChecklistAssessmentService
{
    public function save(array $data): HomeSafetyChecklistAssessment
    {
        $conditions = [
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ];

        $record = HomeSafetyChecklistAssessment::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('HomeSafetyChecklistAssessment Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('home_safety_checklist_assessment')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $record->user_id,
                    'client_type' => $record->client_type,
                    'uuid' => $record->uuid,
                    'home_safety_checklist_assessment_id' => $record->id,
                ])
                ->log('Home Safety Checklist Assessment updated');

            $record->save();
        }

        return $record;
    }
}
