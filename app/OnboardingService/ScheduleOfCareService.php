<?php

namespace App\OnboardingService;

use App\Models\ScheduleOfCare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ScheduleOfCareService
{
    public function saveMany(array $schedules, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($schedules as $schedule) {

            if (empty($schedule['type_of_service'])) {
                continue;
            }

            // ✅ Generate goal_key if not provided
            if (empty($schedule['goal_key'])) {
                $schedule['goal_key'] = 'goal_' . Str::uuid();
            }

            // 🔍 Find or create using goal_key + enquiry
            $record = ScheduleOfCare::firstOrNew([
                'initial_enquiry_id' => $initialEnquiryId,
                'goal_key' => $schedule['goal_key'],
            ]);

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($schedule);
            $record->initial_enquiry_id = $initialEnquiryId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("ScheduleOfCare: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => optional($record->initialEnquiry)->uuid,
                ]);

                activity()
                    ->useLog('schedule_of_care')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'initial_enquiry_id' => $record->initial_enquiry_id,
                        'uuid' => $schedule['uuid'] ?? optional($record->initialEnquiry)->uuid,
                        'client_type' => $schedule['client_type'] ?? optional($record->initialEnquiry)->client_type,
                        'staff_id' => $schedule['staff_id'] ?? optional($record->initialEnquiry)->staff_id,
                        'user_id' => $schedule['user_id'] ?? optional($record->initialEnquiry)->user_id,
                    ])
                    ->log('ScheduleOfCare record has been updated');

            } else {
                $record->save();
            }

            $saved[] = $record;
        }

        return $saved;
    }
}
