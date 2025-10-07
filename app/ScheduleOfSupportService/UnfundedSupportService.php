<?php

namespace App\ScheduleOfSupportService;

use App\Models\UnfundedSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UnfundedSupportService
{
    public function save(array $data): UnfundedSupport
    {
        $conditions = [
            'schedule_of_support_id' => $data['schedule_of_support_id'],
        ];

        $record = UnfundedSupport::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $oldValues = array_intersect_key($record->getOriginal(), $changes);

            $record->save();

            Log::info("UnfundedSupport changes", [
                'changes' => $changes,
                'original' => $oldValues,
            ]);

            activity()
                ->useLog('unfunded_support')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $oldValues,
                    'schedule_of_support_id' => $record->schedule_of_support_id,
                ])
                ->log('Unfunded Support record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
