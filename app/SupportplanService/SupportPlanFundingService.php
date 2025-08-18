<?php

namespace App\SupportplanService;

use App\Models\SupportPlanFunding;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanFundingService
{
    public function save(array $data): SupportPlanFunding
    {
        $funding = SupportPlanFunding::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $funding->fill($data);

        if ($funding->isDirty()) {
            $changes = $funding->getDirty();
            $original = array_intersect_key($funding->getOriginal(), $changes);

            Log::info('SupportPlanFunding Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $funding->save();

            activity()
                ->useLog('support_plan_funding')
                ->performedOn($funding)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $funding->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanFunding record has been updated');
        }

        return $funding;
    }
}
