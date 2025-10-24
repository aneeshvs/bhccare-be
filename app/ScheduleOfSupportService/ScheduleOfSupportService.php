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
        $isNew = !$schedule->exists; // Check if creating first time

        // Store original values before fill
        $original = $schedule->getOriginal();

        // Apply new values
        $schedule->fill($data);

        // Detect changed fields
        $changes = $schedule->getDirty();
        $oldValues = $isNew ? [] : array_intersect_key($original, $changes);

        // Save first (important)
        $schedule->save();

        // Log only when created or updated
        if ($isNew || !empty($changes)) {

            activity()
                ->useLog('schedule_of_support')
                ->performedOn($schedule)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $oldValues,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $schedule->user_id,
                    'client_type' => $schedule->client_type,
                    'uuid' => $schedule->uuid,
                    'schedule_of_support_id' => $schedule->id,
                ])
                ->log($isNew
                    ? 'Schedule of Support record created'
                    : 'Schedule of Support record updated'
                );

            Log::info('ScheduleOfSupport Change Logged', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $oldValues,
            ]);
        }

        return $schedule;
    }
}
