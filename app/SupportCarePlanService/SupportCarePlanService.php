<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportCarePlanService
{
    public function save(array $data): SupportCarePlan
    {
        $conditions = [
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ];

        $plan = SupportCarePlan::firstOrNew($conditions);
        $plan->fill($data);

        if ($plan->isDirty()) {
            $changes = $plan->getDirty();
            $original = array_intersect_key($plan->getOriginal(), $changes);

            Log::info('SupportCarePlan Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('support_care_plan')
                ->performedOn($plan)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $plan->user_id,
                    'client_type' => $plan->client_type,
                    'uuid' => $plan->uuid,
                    'support_care_plan_id' => $plan->id,
                ])
                ->log('Support Care Plan record has been updated');

            $plan->save();
        }

        return $plan;
    }
}
