<?php

namespace App\SupportplanService;

use App\Models\SupportPlanCarePartner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanCarePartnerService
{
    public function save(array $data): SupportPlanCarePartner
    {
        $carePartner = SupportPlanCarePartner::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

          $carePartner->fill($data);

        if ($carePartner->isDirty()) {
            $changes = $carePartner->getDirty();
            $original = array_intersect_key($carePartner->getOriginal(), $changes);

            Log::info('SupportPlanCarePartner Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('support_plan_care_partner')
                ->performedOn($carePartner)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                     'user_id' => $data['user_id'] ?? null,
                     'client_type' => $data['client_type'] ?? null,
                    'uuid' => $carePartner->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanCarePartner record has been updated');

            $carePartner->save();
        }

        return $carePartner;
    }
}
