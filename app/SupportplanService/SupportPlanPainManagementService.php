<?php

namespace App\SupportplanService;

use App\Models\SupportPlanPainManagement;
use Illuminate\Support\Facades\Auth;

class SupportPlanPainManagementService
{
    public function save(array $data): SupportPlanPainManagement
    {
        $pain = SupportPlanPainManagement::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $pain->fill($data);

        if ($pain->isDirty()) {
            $changes  = $pain->getDirty();
            $original = array_intersect_key($pain->getOriginal(), $changes);

            $pain->save();

            activity()
                ->useLog('support_plan_pain_management')
                ->performedOn($pain)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $pain->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanPainManagement record updated');
        } else {
            $pain->save();
        }

        return $pain;
    }
}
