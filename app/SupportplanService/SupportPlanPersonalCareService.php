<?php

namespace App\SupportplanService;

use App\Models\SupportPlanPersonalCare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanPersonalCareService
{
    public function save(array $data): SupportPlanPersonalCare
    {
        $personalCare = SupportPlanPersonalCare::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $personalCare->fill($data);

        if ($personalCare->isDirty()) {
            $changes  = $personalCare->getDirty();
            $original = array_intersect_key($personalCare->getOriginal(), $changes);

            Log::info('SupportPlanPersonalCare Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $personalCare->save();

            activity()
                ->useLog('support_plan_personal_care')
                ->performedOn($personalCare)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $personalCare->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanPersonalCare record updated');
        } else {
            $personalCare->save();
        }

        return $personalCare;
    }
}
