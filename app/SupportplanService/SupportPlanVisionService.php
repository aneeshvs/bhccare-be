<?php

namespace App\SupportplanService;

use App\Models\SupportPlanVision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanVisionService
{
    public function save(array $data): SupportPlanVision
    {
        $vision = SupportPlanVision::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $vision->fill($data);

        if ($vision->isDirty()) {
            $changes  = $vision->getDirty();
            $original = array_intersect_key($vision->getOriginal(), $changes);

            Log::info('SupportPlanVision Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $vision->save();

            activity()
                ->useLog('support_plan_vision')
                ->performedOn($vision)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $vision->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanVision record updated');
        } else {
            $vision->save();
        }

        return $vision;
    }
}
