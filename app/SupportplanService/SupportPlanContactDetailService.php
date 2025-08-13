<?php

namespace App\SupportplanService;

use App\Models\SupportPlanContactDetail;
use Illuminate\Support\Facades\Auth;

class SupportPlanContactDetailService
{
    public function save(array $data): SupportPlanContactDetail
    {
        $contactDetail = SupportPlanContactDetail::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $contactDetail->fill($data);

        if ($contactDetail->isDirty()) {
            $changes = $contactDetail->getDirty();
            $original = array_intersect_key($contactDetail->getOriginal(), $changes);

            $contactDetail->save();

            activity()
                ->useLog('support_plan_contact_detail')
                ->performedOn($contactDetail)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $contactDetail->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanContactDetail record has been updated');
        }

        return $contactDetail;
    }
}
