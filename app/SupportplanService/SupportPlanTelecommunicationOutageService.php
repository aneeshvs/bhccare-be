<?php

namespace App\SupportplanService;

use App\Models\SupportPlanTelecommunicationOutage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanTelecommunicationOutageService
{
    public function save(array $data): SupportPlanTelecommunicationOutage
    {
        $record = SupportPlanTelecommunicationOutage::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $record->fill($data);

        if ($record->isDirty()) {
            $changes  = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('SupportPlanTelecommunicationOutage Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $record->save();

            activity()
                ->useLog('support_plan_telecommunication_outage')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanTelecommunicationOutage record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
