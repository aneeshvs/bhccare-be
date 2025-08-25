<?php

namespace App\SupportplanService;

use App\Models\SupportPlanBehaviourSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanBehaviourSupportService
{
    public function save(array $data): SupportPlanBehaviourSupport
    {
        $behaviourSupport = SupportPlanBehaviourSupport::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $behaviourSupport->fill($data);

        if ($behaviourSupport->isDirty()) {
            $changes  = $behaviourSupport->getDirty();
            $original = array_intersect_key($behaviourSupport->getOriginal(), $changes);

            // Debug log
            Log::info('SupportPlanBehaviourSupport Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $behaviourSupport->save();

            activity()
                ->useLog('support_plan_behaviour_support')
                ->performedOn($behaviourSupport)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $behaviourSupport->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanBehaviourSupport record updated');
        } else {
            $behaviourSupport->save();
        }

        return $behaviourSupport;
    }
}
