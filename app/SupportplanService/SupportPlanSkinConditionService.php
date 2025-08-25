<?php

namespace App\SupportplanService;

use App\Models\SupportPlanSkinCondition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanSkinConditionService
{
    public function save(array $data): SupportPlanSkinCondition
    {
        $skin = SupportPlanSkinCondition::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $skin->fill($data);

        if ($skin->isDirty()) {
            $changes  = $skin->getDirty();
            $original = array_intersect_key($skin->getOriginal(), $changes);

            Log::info('SupportPlanSkinCondition Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $skin->save();

            activity()
                ->useLog('support_plan_skin_condition')
                ->performedOn($skin)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $skin->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanSkinCondition record updated');
        } else {
            $skin->save();
        }

        return $skin;
    }
}
