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
        $isNew = !$record->exists; // Detect first-time creation

        $record->fill($data);

        // Detect changes before saving
        $changes = $record->getDirty();
        $original = $isNew ? [] : array_intersect_key($record->getOriginal(), $changes);

        // Save first so ID & UUID exist
        $record->save();

        if ($isNew || !empty($changes)) {
            activity()
                ->useLog('home_safety_checklist_assessment')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $record->user_id,
                    'client_type' => $record->client_type,
                    'uuid' => $record->uuid,
                    'home_safety_checklist_assessment_id' => $record->id,
                ])
                ->log($isNew
                    ? 'Home Safety Checklist Assessment created'
                    : 'Home Safety Checklist Assessment updated'
                );

            Log::info('HomeSafetyChecklistAssessment Change Logged', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $original,
            ]);
        }

        return $record;
    }
}
