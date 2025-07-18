<?php

namespace App\OnboardingService;

use App\Models\BehaviourSupport;
use Illuminate\Support\Facades\Auth;

class BehaviourSupportService
{
    public function save(array $data): BehaviourSupport
    {
        $support = BehaviourSupport::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $support->fill([
            'has_support_plan' => $data['has_support_plan'] ?? false,
            'plan_copy_received' => $data['plan_copy_received'] ?? false,
        ]);

        if ($support->isDirty()) {
            $changes = $support->getDirty();
            $original = array_intersect_key($support->getOriginal(), $changes);

            $support->save();

            activity()
                ->useLog('behaviour_support')
                ->performedOn($support)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('BehaviourSupport record has been updated');
        } else {
            $support->save();
        }

        return $support;
    }
}
