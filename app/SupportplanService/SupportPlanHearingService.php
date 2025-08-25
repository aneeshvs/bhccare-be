<?php

namespace App\SupportplanService;

use App\Models\SupportPlanHearing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanHearingService
{
    public function save(array $data): SupportPlanHearing
    {
        $hearing = SupportPlanHearing::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $hearing->fill($data);

        if ($hearing->isDirty()) {
            $changes  = $hearing->getDirty();
            $original = array_intersect_key($hearing->getOriginal(), $changes);

            Log::info('SupportPlanHearing Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $hearing->save();

            activity()
                ->useLog('support_plan_hearing')
                ->performedOn($hearing)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $hearing->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanHearing record updated');
        } else {
            $hearing->save();
        }

        return $hearing;
    }
}
