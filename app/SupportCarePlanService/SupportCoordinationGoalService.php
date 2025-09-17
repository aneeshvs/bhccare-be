<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCoordinationGoal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SupportCoordinationGoalService
{
    public function saveMany(array $goals, int $supportCarePlanId): array
    {
        $saved = [];
        $processedIds = [];
        $processedKeys = [];

        foreach ($goals as $goal) {
            if (empty($goal['goals_of_support'])) {
                continue;
            }

            $record = null;

            // 1️⃣ Prefer update by ID
            if (!empty($goal['id'])) {
                $record = SupportCoordinationGoal::where('id', $goal['id'])
                    ->where('support_care_plan_id', $supportCarePlanId)
                    ->first();
            }

            // 2️⃣ Fallback to goal_key
            if (!$record && !empty($goal['goal_key'])) {
                $record = SupportCoordinationGoal::where('support_care_plan_id', $supportCarePlanId)
                    ->where('goal_key', $goal['goal_key'])
                    ->first();
            }

            // 3️⃣ Otherwise create new
            if (!$record) {
                if (empty($goal['goal_key'])) {
                    $goal['goal_key'] = 'goal_' . Str::uuid();
                }
                $record = new SupportCoordinationGoal();
                $record->support_care_plan_id = $supportCarePlanId;
                $record->goal_key = $goal['goal_key'];
            }

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($goal);
            $record->support_care_plan_id = $supportCarePlanId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("SupportCoordinationGoal: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'support_care_plan_id' => $record->support_care_plan_id,
                ]);

                activity()
                    ->useLog('support_coordination_goals')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'support_care_plan_id' => $record->support_care_plan_id,
                        'uuid' => $goal['uuid'] ?? optional($record->supportCarePlan)->uuid,
                        'user_id' => $goal['user_id'] ?? optional($record->supportCarePlan)->user_id,
                        'client_type' => $goal['client_type'] ?? optional($record->supportCarePlan)->client_type,
                        'staff_id' => $goal['staff_id'] ?? optional($record->supportCarePlan)->staff_id,
                    ])
                    ->log('SupportCoordinationGoal record has been updated');
            } else {
                $record->save();
            }

            $saved[] = $record;
            $processedIds[] = $record->id;
            $processedKeys[] = $record->goal_key;
        }

        // 4️⃣ Delete stale records
        SupportCoordinationGoal::where('support_care_plan_id', $supportCarePlanId)
            ->when(!empty($processedIds), fn($q) => $q->whereNotIn('id', $processedIds))
            ->delete();

        return $saved;
    }
}
