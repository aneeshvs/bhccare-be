<?php
namespace App\HomeSafetyChecklistAssessmentService;

use App\Models\HomeSafetyInsideResidence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeSafetyInsideResidenceService
{
    public function save(array $data): HomeSafetyInsideResidence
    {
        $conditions = [
            'home_safety_checklist_assessment_id' => $data['home_safety_checklist_assessment_id'],
        ];

        $record = HomeSafetyInsideResidence::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('HomeSafetyInsideResidence Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('home_safety_inside_residence')
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
                ->log('Home Safety Inside Residence updated');

            $record->save();
        }

        return $record;
    }
}
