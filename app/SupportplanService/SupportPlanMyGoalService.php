<?php

namespace App\SupportplanService;

use App\Models\SupportPlanMyGoal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SupportPlanMyGoalService
{
    /**
     * Save multiple goals for a given Support Plan.
     *
     * @param array $data
     * @param int   $supportPlanId
     * @return array
     */
    public function saveMany(array $data, int $supportPlanId): array
    {
        $saved = [];

        foreach ($data as $row) {

            // Skip empty rows
            if (empty($row['goal'])) {
                continue;
            }

            // Auto-generate goal_key if not provided
            if (empty($row['goal_key'])) {
                $row['goal_key'] = 'goal_' . Str::uuid();
            }

            // Fetch or create new goal using support_plan_id + goal_key
            $goal = SupportPlanMyGoal::firstOrNew([
                'support_plan_id' => $supportPlanId,
                'goal_key'        => $row['goal_key'],
            ]);

            $original = $goal->exists ? $goal->getOriginal() : [];

            // Fill new values
            $goal->fill($row);
            $goal->support_plan_id = $supportPlanId;

            // Capture dirty changes
            if ($goal->isDirty()) {
                $dirty = $goal->getDirty();
                $oldValues = array_intersect_key($original, $dirty);

                Log::info("SupportPlanMyGoal updated", [
                    'support_plan_id' => $supportPlanId,
                    'goal_key'        => $row['goal_key'],
                    'dirty'           => $dirty,
                    'original'        => $oldValues,
                ]);

                $goal->save();

                // Record activity log
                activity()
                    ->useLog('support_plan_my_goal')
                    ->performedOn($goal)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes'      => $dirty,
                        'old'             => $oldValues,
                        'staff_id'        => $row['staff_id']
                                             ?? optional($goal->supportPlan)->staff_id,
                        'user_id'         => $row['user_id']
                                             ?? optional($goal->supportPlan)->user_id,
                        'client_type'     => $row['client_type']
                                             ?? optional($goal->supportPlan)->client_type,
                        'uuid'            => $goal->uuid
                                             ?? optional($goal->supportPlan)->uuid,
                        'support_plan_id' => $supportPlanId,
                    ])
                    ->log('SupportPlanMyGoal record updated');

            } else {

                // Save normally even if unchanged
                $goal->save();
            }

            $saved[] = $goal;
        }

        return $saved;
    }
}
