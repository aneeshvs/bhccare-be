<?php

namespace App\ScheduleOfSupportService;

use App\Models\FundedSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FundedSupportService
{
    public function save(array $data): FundedSupport
    {
        $conditions = [
            'schedule_of_support_id' => $data['schedule_of_support_id'],

        ];

        $record = FundedSupport::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $oldValues = array_intersect_key($record->getOriginal(), $changes);

            $record->save();

            Log::info("FundedSupport changes", [
                'changes' => $changes,
                'original' => $oldValues,
            ]);

            activity()
                ->useLog('funded_support')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old'        => $oldValues,
                    'schedule_of_support_id' => $record->schedule_of_support_id,
                    'uuid' => $record->uuid ?? null,

                ])
                ->log('FundedSupport record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
