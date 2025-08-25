<?php

namespace App\SupportplanService;

use App\Models\SupportPlanFallsRisk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanFallsRiskService
{
    public function save(array $data): SupportPlanFallsRisk
    {
        $fallsRisk = SupportPlanFallsRisk::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $fallsRisk->fill($data);

        if ($fallsRisk->isDirty()) {
            $changes  = $fallsRisk->getDirty();
            $original = array_intersect_key($fallsRisk->getOriginal(), $changes);

            // Debug log
            Log::info('SupportPlanFallsRisk Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $fallsRisk->save();

            activity()
                ->useLog('support_plan_falls_risk')
                ->performedOn($fallsRisk)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $fallsRisk->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanFallsRisk record updated');
        } else {
            $fallsRisk->save();
        }

        return $fallsRisk;
    }
}
