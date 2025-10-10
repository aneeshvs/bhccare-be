<?php

namespace App\HomeSafetyChecklistAssessmentService;

use App\Models\OutsideResidenceAssessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OutsideResidenceAssessmentService
{
    public function save(array $data): OutsideResidenceAssessment
    {
        $conditions = [
            'home_safety_checklist_assessment_id' => $data['home_safety_checklist_assessment_id'],
        ];

        $record = OutsideResidenceAssessment::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('OutsideResidenceAssessment Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('outside_residence_assessment')
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
                ->log('Outside Residence Assessment updated');

            $record->save();
        }

        return $record;
    }
}
