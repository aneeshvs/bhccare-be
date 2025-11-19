<?php

namespace App\SupportplanService;

use App\Models\SupportPlanService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SupportPlanServiceService
{
    /**
     * Save multiple services for a support plan
     */
    public function saveMany(array $data, int $supportPlanId): array
    {
        $saved = [];
        $processedIds = [];

        foreach ($data as $row) {

            // Skip empty rows
            $allEmpty = true;
            foreach ($row as $value) {
                if (!empty($value)) {
                    $allEmpty = false;
                    break;
                }
            }
            if ($allEmpty) {
                continue;
            }

            // Auto-generate goal_key if missing
            if (empty($row['goal_key'])) {
                $row['goal_key'] = 'goal_' . Str::uuid();
            }

            $record = null;

            /**
             * 1️⃣ First try to match by ID
             */
            if (!empty($row['id'])) {
                $record = SupportPlanService::where('id', $row['id'])
                    ->where('support_plan_id', $supportPlanId)
                    ->first();
            }

            /**
             * 2️⃣ Next match by goal_key
             */
            if (!$record && !empty($row['goal_key'])) {
                $record = SupportPlanService::where('support_plan_id', $supportPlanId)
                    ->where('goal_key', $row['goal_key'])
                    ->first();
            }

            /**
             * 3️⃣ Create new if still not found
             */
            if (!$record) {
                $record = new SupportPlanService();
                $record->support_plan_id = $supportPlanId;
                $record->goal_key = $row['goal_key'];
            }

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($row);
            $record->support_plan_id = $supportPlanId;

            if ($record->isDirty()) {

                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("SupportPlanService Updated", [
                    'changes' => $changes,
                    'old' => $oldValues,
                    'uuid' => optional($record->supportPlan)->uuid,
                ]);

                activity()
                    ->useLog('support_plan_service')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes'       => $changes,
                        'old'              => $oldValues,
                        'support_plan_id'  => $supportPlanId,
                        'uuid'             => optional($record->supportPlan)->uuid,
                        'user_id'          => $row['user_id'] ?? optional($record->supportPlan)->user_id,
                        'client_type'      => $row['client_type'] ?? optional($record->supportPlan)->client_type,
                        'staff_id'         => $row['staff_id'] ?? optional($record->supportPlan)->staff_id,
                    ])
                    ->log('Support Plan Service updated');

            } else {
                $record->save(); // Save even if no changes
            }

            $saved[] = $record;
            $processedIds[] = $record->id;
        }

        return $saved;
    }
}
