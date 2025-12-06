<?php
namespace App\SupportCarePlanService;

use App\Models\SupportCarePlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportCarePlanService
{
    public function save(array $data): SupportCarePlan
    {
        $conditions = [
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ];
        if (!empty($data['uuid'])) {
            $conditions['uuid'] = $data['uuid'];
        }

        $plan = SupportCarePlan::firstOrNew($conditions);
        $isNew = !$plan->exists; // detect if first time creating

        $plan->fill($data);
        $changes = $plan->getDirty();
        $original = $isNew ? [] : array_intersect_key($plan->getOriginal(), $changes);

        // Save before logging so ID and UUID exist
        $plan->save();

        if ($isNew || !empty($changes)) {
            activity()
                ->useLog('support_care_plan')
                ->performedOn($plan)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $plan->user_id,
                    'client_type' => $plan->client_type,
                    'uuid' => $plan->uuid,
                    'support_care_plan_id' => $plan->id,
                ])
                ->log($isNew
                    ? 'Support Care Plan record created'
                    : 'Support Care Plan record updated'
                );

            Log::info('SupportCarePlan Change Logged', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $original,
            ]);
        }

        return $plan;
    }
}
