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
        if (!empty($data['uuid'])) {
            $conditions['uuid'] = $data['uuid'];
        }

        $plan = SupportPlan::firstOrNew($conditions);
        $isNew = !$plan->exists; // Detect create vs update

        // Keep old original values before modification
        $original = $plan->getOriginal();

        // Apply updated values
        $plan->fill($data);

        // Detect changed fields
        $changes = $plan->getDirty();
        $oldValues = $isNew ? [] : array_intersect_key($original, $changes);

        // Save before logging to ensure ID/UUID exist
        $plan->save();

        // Log only when new or changed
        if ($isNew || !empty($changes)) {

            activity()
                ->useLog('support_plan')
                ->performedOn($plan)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $oldValues,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $plan->user_id,
                    'client_type' => $plan->client_type,
                    'uuid' => $plan->uuid,
                    'support_plan_id' => $plan->id,
                ])
                ->log($isNew
                    ? 'SupportPlan record created'
                    : 'SupportPlan record updated'
                );

            Log::info('SupportPlan Change Logged', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $oldValues,
            ]);
        }

        return $plan;
    }
}
