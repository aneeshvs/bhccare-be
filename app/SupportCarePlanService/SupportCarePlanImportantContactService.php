<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlanImportantContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportCarePlanImportantContactService
{
    public function save(array $data): SupportCarePlanImportantContact
    {
        $conditions = [
            'support_care_plan_id' => $data['support_care_plan_id'],
        ];

        $record = SupportCarePlanImportantContact::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $oldValues = array_intersect_key($record->getOriginal(), $changes);

            $record->save();

            Log::info("ImportantContacts changes", [
                'changes' => $changes,
                'original' => $oldValues,
            ]);

            activity()
                ->useLog('support_care_plan_important_contacts')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old'        => $oldValues,
                    'support_care_plan_id' => $record->support_care_plan_id,
                ])
                ->log('Important Contacts record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
