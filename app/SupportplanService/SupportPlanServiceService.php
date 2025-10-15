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

        foreach ($data as $row) {
            if (empty($row['name'])) {
                continue; // Skip rows with no name
            }

            // ✅ Generate goal_key if missing
            if (empty($row['goal_key'])) {
                $row['goal_key'] = 'goal_' . Str::uuid();
            }

            // ✅ Identify the record by goal_key + support_plan_id
            $service = SupportPlanService::firstOrNew([
                'support_plan_id' => $supportPlanId,
                'goal_key'        => $row['goal_key'],
            ]);

            $original = $service->exists ? $service->getOriginal() : [];

            $service->fill($row);
            $service->support_plan_id = $supportPlanId;

            if ($service->isDirty()) {
                $changes = $service->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                Log::info('SupportPlanService Changes', [
                    'dirty'    => $changes,
                    'original' => $oldValues,
                ]);

                $service->save();

                activity()
                    ->useLog('support_plan_service')
                    ->performedOn($service)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes'       => $changes,
                        'old'              => $oldValues,
                        'support_plan_id'  => $supportPlanId,
                        'staff_id'         => $row['staff_id'] ?? optional($service->supportPlan)->staff_id,
                        'user_id'          => $row['user_id'] ?? optional($service->supportPlan)->user_id,
                        'client_type'      => $row['client_type'] ?? optional($service->supportPlan)->client_type,
                        'uuid'             => $service->uuid ?? optional($service->supportPlan)->uuid,
                    ])
                    ->log('SupportPlanService record has been updated');
            } else {
                $service->save();
            }

            $saved[] = $service;
        }

        return $saved;
    }
}
