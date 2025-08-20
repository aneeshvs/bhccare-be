<?php

namespace App\SupportplanService;

use App\Models\SupportPlanLivingArrangement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanLivingArrangementService
{
    public function save(array $data): SupportPlanLivingArrangement
    {
        $living = SupportPlanLivingArrangement::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $living->fill($data);

        if ($living->isDirty()) {
            $changes = $living->getDirty();
            $original = array_intersect_key($living->getOriginal(), $changes);

            Log::info('SupportPlanLivingArrangement Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $living->save();

            activity()
                ->useLog('support_plan_living_arrangement')
                ->performedOn($living)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $living->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanLivingArrangement record has been updated');
        }

        return $living;
    }
}
