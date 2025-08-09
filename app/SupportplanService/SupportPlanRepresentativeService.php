<?php

namespace App\SupportplanService;

use App\Models\SupportPlanRepresentative;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanRepresentativeService
{
    public function save(array $data): SupportPlanRepresentative
    {
        $representative = SupportPlanRepresentative::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $representative->fill($data);

        if ($representative->isDirty()) {
            $changes = $representative->getDirty();
            $original = array_intersect_key($representative->getOriginal(), $changes);

            Log::info('SupportPlanRepresentative Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('support_plan_representative')
                ->performedOn($representative)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                     'user_id' => $data['user_id'] ?? null,
                     'client_type' => $data['client_type'] ?? null,
                    'uuid' => $representative->uuid,

                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanRepresentative record has been updated');

            $representative->save();
        }

        return $representative;
    }
}
