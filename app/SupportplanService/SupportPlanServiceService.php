<?php

namespace App\SupportplanService;

use App\Models\SupportPlanService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
                // Skip this row if `name` is missing/empty
                continue;
            }
            $service = SupportPlanService::firstOrNew([
                'support_plan_id' => $supportPlanId,
                'name' => $row['name'] ?? null,

            ]);

            $service->fill($row);
            $service->support_plan_id = $supportPlanId;

            if ($service->isDirty()) {
                $changes = $service->getDirty();
                $original = array_intersect_key($service->getOriginal(), $changes);

                Log::info('SupportPlanService Changes', [
                    'dirty' => $changes,
                    'original' => $original,
                ]);

                $service->save();

                activity()
                    ->useLog('support_plan_service')
                    ->performedOn($service)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $original,
                        'staff_id'        => $row['staff_id'] ?? optional($service->supportPlan)->staff_id,
                        'user_id'          => $row['user_id'] ?? optional($service->supportPlan)->user_id,
                        'client_type'      => $row['client_type'] ?? optional($service->supportPlan)->client_type,
                        'uuid'             => $service->uuid ?? optional($service->supportPlan)->uuid,

                        'support_plan_id' => $supportPlanId,
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
