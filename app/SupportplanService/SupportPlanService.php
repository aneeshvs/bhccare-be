<?php

namespace App\SupportplanService;

use App\Models\SupportPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SupportPlanService
{
    public function save(array $data): SupportPlan
    {
        $conditions = [
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ];

        $plan = SupportPlan::firstOrNew($conditions);
        $plan->fill($data);

        if ($plan->isDirty()) {
            $changes = $plan->getDirty();
            $original = array_intersect_key($plan->getOriginal(), $changes);

            Log::info('SupportPlan Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('support_plan')
                ->performedOn($plan)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $plan->user_id,
                    'client_type' => $plan->client_type,
                    'uuid' => $plan->uuid,
                    'support_plan_id' => $plan->id,
                ])
                ->log('SupportPlan record has been updated');

            $plan->save();
        }

        return $plan;
    }


}
