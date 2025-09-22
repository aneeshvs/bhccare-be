<?php
namespace App\SupportCarePlanService;

use App\Models\SilGoal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SilGoalService
{
    /**
     * Save multiple goals for a Support Care Plan
     *
     * @param array $goals
     * @param int $supportCarePlanId
     * @return array
     */
    public function saveMany(array $goals, int $supportCarePlanId): array
    {
        $saved = [];
        $processedIds = [];

        foreach ($goals as $goal) {

            // Skip empty goals
            if (empty($goal['goals_of_support'])) {
                continue;
            }

            if (empty($goal['goal_key'])) {
                $goal['goal_key'] = 'goal_' . Str::uuid();
            }

            $record = null;

            // 1️⃣ Update by ID if provided
            if (!empty($goal['id'])) {
                $record = SilGoal::where('id', $goal['id'])
                    ->where('support_care_plan_id', $supportCarePlanId)
                    ->first();
            }

            // 2️⃣ Update by goal_key if ID not present
            if (!$record && !empty($goal['goal_key'])) {
                $record = SilGoal::where('support_care_plan_id', $supportCarePlanId)
                    ->where('goal_key', $goal['goal_key'])
                    ->first();
            }

            // 3️⃣ If still not found, create a new goal
            if (!$record) {
                $record = new SilGoal();
                $record->support_care_plan_id = $supportCarePlanId;
                $record->goal_key = $goal['goal_key'] ?? 'goal_' . Str::uuid();
            }

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($goal);
            $record->support_care_plan_id = $supportCarePlanId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("SilGoal: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => optional($record->supportCarePlan)->uuid,
                ]);

                activity()
                    ->useLog('sil_goals')
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
                        'category' => $goal['category'] ?? 'sil',
                    ])
                    ->log('SilGoal record has been updated');
            } else {
                $record->save();
            }

            $saved[] = $record;
            $processedIds[] = $record->id;
        }



        return $saved;
    }
}
