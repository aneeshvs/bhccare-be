<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlanEmergencyDisasterPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportCarePlanEmergencyDisasterPlanService
{
    public function save(array $data): SupportCarePlanEmergencyDisasterPlan
    {
        $conditions = [
            'support_care_plan_id' => $data['support_care_plan_id'],
        ];

        $plan = SupportCarePlanEmergencyDisasterPlan::firstOrNew($conditions);
        $plan->fill($data);

        if ($plan->isDirty()) {
            $changes = $plan->getDirty();
            $original = array_intersect_key($plan->getOriginal(), $changes);

            Log::info('EmergencyDisasterPlan Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('support_care_plan_emergency_disaster')
                ->performedOn($plan)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'           => $changes,
                    'old'                  => $original,
                    'support_care_plan_id' => $plan->support_care_plan_id,
                    'user_id'              => $data['user_id'] ?? null,
                ])
                ->log('Support Care Plan Emergency & Disaster record has been updated');

            $plan->save();
        }

        return $plan;
    }
}
