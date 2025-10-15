<?php

namespace App\SupportplanService;

use App\Models\SupportPlanMyGoal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SupportPlanMyGoalService
{
    /**
     * Save multiple goals for a support plan
     */
    public function saveMany(array $data, int $supportPlanId): array
    {
        $saved = [];

        foreach ($data as $row) {
            if (empty($row['goal'])) {
                continue; // skip empty rows
            }

            // ✅ Auto-generate goal_key if missing
            if (empty($row['goal_key'])) {
                $row['goal_key'] = 'goal_' . Str::uuid();
            }

            // ✅ Use goal_key + support_plan_id to uniquely identify record
            $goal = SupportPlanMyGoal::firstOrNew([
                'support_plan_id' => $supportPlanId,
                'goal_key'        => $row['goal_key'],
            ]);

            $original = $goal->exists ? $goal->getOriginal() : [];

            $goal->fill($row);
            $goal->support_plan_id = $supportPlanId;

            if ($goal->isDirty()) {
                $changes  = $goal->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                Log::info('SupportPlanMyGoal Changes', [
                    'dirty'    => $changes,
                    'original' => $oldValues,
                ]);

                $goal->save();

                activity()
                    ->useLog('support_plan_my_goal')
                    ->performedOn($goal)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes'      => $changes,
                        'old'             => $oldValues,
                        'staff_id'        => $row['staff_id'] ?? optional($goal->supportPlan)->staff_id,
                        'user_id'         => $row['user_id'] ?? optional($goal->supportPlan)->user_id,
                        'client_type'     => $row['client_type'] ?? optional($goal->supportPlan)->client_type,
                        'uuid'            => $goal->uuid ?? optional($goal->supportPlan)->uuid,
                        'support_plan_id' => $supportPlanId,
                    ])
                    ->log('SupportPlanMyGoal record has been updated');
            } else {
                $goal->save(); // Save even if not dirty
            }

            $saved[] = $goal;
        }

        return $saved;
    }
}
