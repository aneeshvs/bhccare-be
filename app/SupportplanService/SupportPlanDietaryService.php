<?php

namespace App\SupportplanService;

use App\Models\SupportPlanDietary;
use Illuminate\Support\Facades\Auth;

class SupportPlanDietaryService
{
    public function save(array $data): SupportPlanDietary
    {
        $dietary = SupportPlanDietary::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $dietary->fill($data);

        if ($dietary->isDirty()) {
            $changes  = $dietary->getDirty();
            $original = array_intersect_key($dietary->getOriginal(), $changes);

            $dietary->save();

            activity()
                ->useLog('support_plan_dietary')
                ->performedOn($dietary)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $dietary->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanDietary record updated');
        } else {
            $dietary->save();
        }

        return $dietary;
    }
}
