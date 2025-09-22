<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlanCommunicationPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportCarePlanCommunicationPlanService
{
    public function save(array $data): SupportCarePlanCommunicationPlan
    {
        $conditions = [
            'support_care_plan_id' => $data['support_care_plan_id'],
        ];

        $plan = SupportCarePlanCommunicationPlan::firstOrNew($conditions);
        $plan->fill($data);

        if ($plan->isDirty()) {
            $changes = $plan->getDirty();
            $original = array_intersect_key($plan->getOriginal(), $changes);

            Log::info('SupportCarePlanCommunicationPlan Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('support_care_plan_communication')
                ->performedOn($plan)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'           => $changes,
                    'old'                  => $original,
                    'support_care_plan_id' => $plan->support_care_plan_id,
                    'user_id'              => $data['user_id'] ?? null,
                ])
                ->log('Support Care Plan Communication record has been updated');

            $plan->save();
        }

        return $plan;
    }
}
