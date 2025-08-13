<?php

namespace App\SupportplanService;

use App\Models\NonResponseVisitPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NonResponseVisitPlanService
{
    public function save(array $data): NonResponseVisitPlan
    {
        $plan = NonResponseVisitPlan::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $plan->fill($data);

        if ($plan->isDirty()) {
            $changes = $plan->getDirty();
            $original = array_intersect_key($plan->getOriginal(), $changes);

            Log::info('NonResponseVisitPlan Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $plan->save();

            activity()
                ->useLog('non_response_visit_plan')
                ->performedOn($plan)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $plan->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('NonResponseVisitPlan record has been updated');
        }

        return $plan;
    }
}
