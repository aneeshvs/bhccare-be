<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlanLocalServicesContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportCarePlanLocalServicesContactService
{
    public function save(array $data): SupportCarePlanLocalServicesContact
    {
        $conditions = [
            'support_care_plan_id' => $data['support_care_plan_id'],
        ];

        $record = SupportCarePlanLocalServicesContact::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes   = $record->getDirty();
            $oldValues = array_intersect_key($record->getOriginal(), $changes);

            $record->save();

            Log::info("LocalServicesContact changes", [
                'changes'  => $changes,
                'original' => $oldValues,
            ]);

            activity()
                ->useLog('support_care_plan_local_services_contacts')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'           => $changes,
                    'old'                  => $oldValues,
                    'support_care_plan_id' => $record->support_care_plan_id,
                ])
                ->log('Local Services Contact record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
