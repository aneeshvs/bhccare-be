<?php

namespace App\SupportplanService;

use App\Models\SupportPlanMyGoal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanMyGoalService
{
    /**
     * Save multiple goals for a support plan
     */
    public function saveMany(array $data, int $supportPlanId): array
    {
        $saved = [];

        foreach ($data as $row) {
            $goal = SupportPlanMyGoal::firstOrNew([
                'support_plan_id' => $supportPlanId,
                'goal'            => $row['goal'] ?? null,
            ]);

            $goal->fill($row);
            $goal->support_plan_id = $supportPlanId;

            if ($goal->isDirty()) {
                $changes  = $goal->getDirty();
                $original = array_intersect_key($goal->getOriginal(), $changes);

                Log::info('SupportPlanMyGoal Changes', [
                    'dirty'    => $changes,
                    'original' => $original,
                ]);

                $goal->save();

                activity()
                    ->useLog('support_plan_my_goal')
                    ->performedOn($goal)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes'      => $changes,
                        'old'             => $original,
                        'staff_id'        => $row['staff_id'] ?? optional($goal->supportPlan)->staff_id,
                        'user_id'          => $row['user_id'] ?? optional($goal->supportPlan)->user_id,
                        'client_type'      => $row['client_type'] ?? optional($goal->supportPlan)->client_type,
                        'uuid'             => $goal->uuid ?? optional($goal->supportPlan)->uuid,
                         'support_plan_id' => $supportPlanId,
                    ])
                    ->log('SupportPlanMyGoal record has been updated');
            } else {
                $goal->save(); // ensure persistence if first time
            }

            $saved[] = $goal;
        }

        return $saved;
    }
}
