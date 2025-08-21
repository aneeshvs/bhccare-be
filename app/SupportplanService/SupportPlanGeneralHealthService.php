<?php

namespace App\SupportplanService;

use App\Models\SupportPlanGeneralHealth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanGeneralHealthService
{
    public function save(array $data): SupportPlanGeneralHealth
    {
        $record = SupportPlanGeneralHealth::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('SupportPlanGeneralHealth Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $record->save();

            activity()
                ->useLog('support_plan_general_health')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'support_plan_id' => $data['support_plan_id'],
                    'staff_id' => $data['staff_id'] ?? null,
                     'user_id' => $data['user_id'] ?? null,
                     'client_type' => $data['client_type'] ?? null,
                ])
                ->log('SupportPlanGeneralHealth updated');
        }

        return $record;
    }
}
