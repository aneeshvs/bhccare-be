<?php

namespace App\SupportplanService;

use App\Models\SupportPlanContinence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanContinenceService
{
    public function save(array $data): SupportPlanContinence
    {
        $continence = SupportPlanContinence::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $continence->fill($data);

        if ($continence->isDirty()) {
            $changes  = $continence->getDirty();
            $original = array_intersect_key($continence->getOriginal(), $changes);

            Log::info('SupportPlanContinence Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $continence->save();

            activity()
                ->useLog('support_plan_continence')
                ->performedOn($continence)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $continence->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanContinence record updated');
        } else {
            $continence->save();
        }

        return $continence;
    }
}
