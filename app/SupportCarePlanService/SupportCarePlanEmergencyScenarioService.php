<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlanEmergencyScenario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportCarePlanEmergencyScenarioService
{
    public function save(array $data): SupportCarePlanEmergencyScenario
    {
        $conditions = [
            'support_care_plan_id' => $data['support_care_plan_id'],
        ];

        $record = SupportCarePlanEmergencyScenario::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $oldValues = array_intersect_key($record->getOriginal(), $changes);

            $record->save();

            Log::info("EmergencyScenarios changes", [
                'changes'  => $changes,
                'original' => $oldValues,
            ]);

            activity()
                ->useLog('support_care_plan_emergency_scenarios')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old'        => $oldValues,
                    'support_care_plan_id' => $record->support_care_plan_id,
                ])
                ->log('Emergency Scenarios record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
