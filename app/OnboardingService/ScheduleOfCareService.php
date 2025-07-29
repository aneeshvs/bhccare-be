<?php

namespace App\OnboardingService;
use Illuminate\Support\Facades\Log;

use App\Models\ScheduleOfCare;
use Illuminate\Support\Facades\Auth;

class ScheduleOfCareService
{
    public function saveMany(array $schedules, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($schedules as $schedule) {
            // Skip empty
            if (empty($schedule['type_of_service'])) {
                continue;
            }

            $record = ScheduleOfCare::firstOrNew([
                'initial_enquiry_id' => $initialEnquiryId,
                'type_of_service' => $schedule['type_of_service'],
            ]);

            $record->fill($schedule);
            $record->initial_enquiry_id = $initialEnquiryId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $original = array_intersect_key($record->getOriginal(), $changes);
                $record->save();
                 // ✅ Add log here to inspect what changes are detected
                Log::info("ScheduleOfCare: changes", [
                    'changes' => $changes,
                    'original' => $original,
                    'uuid' => optional($record->initialEnquiry)->uuid,
                ]);


                activity()
                ->useLog('schedule_of_care')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $record->initial_enquiry_id,
                    'uuid' => $schedule['uuid'] ?? optional($record->initialEnquiry)->uuid,
                    'client_type' => $schedule['client_type'] ?? optional($record->initialEnquiry)->client_type,
                    'staff_id' => $schedule['staff_id'] ?? optional($record->initialEnquiry)->staff_id,
                    'user_id' => $schedule['user_id'] ?? optional($record->initialEnquiry)->user_id,
                ])
                ->log('ScheduleOfCare record has been updated');

            } else {
                $record->save(); // if nothing changed
            }

            $saved[] = $record;
        }

        return $saved;
    }

}
