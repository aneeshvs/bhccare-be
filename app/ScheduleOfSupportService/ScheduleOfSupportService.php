<?php

namespace App\ScheduleOfSupportService;

use App\Models\ScheduleOfSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ScheduleOfSupportService
{
    public function save(array $data): ScheduleOfSupport
    {
        $conditions = [
            'user_id' => $data['user_id'] ?? null,
            'client_type' => $data['client_type'] ?? null,
        ];

        $schedule = ScheduleOfSupport::firstOrNew($conditions);
        $schedule->fill($data);

        if ($schedule->isDirty()) {
            $changes = $schedule->getDirty();
            $original = array_intersect_key($schedule->getOriginal(), $changes);

            Log::info('ScheduleOfSupport Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('schedule_of_support')
                ->performedOn($schedule)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $schedule->user_id,
                    'client_type' => $schedule->client_type,
                    'uuid' => $schedule->uuid,
                    'schedule_of_support_id' => $schedule->id,
                ])
                ->log('Schedule of Support record has been updated');

            $schedule->save();
        }

        return $schedule;
    }
}
