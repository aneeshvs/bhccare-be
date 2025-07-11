<?php
namespace App\OnboardingService;

use App\Models\ScheduleOfCare;

class ScheduleOfCareService
{
    public function saveMany(array $schedules, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($schedules as $schedule) {
            $schedule['initial_enquiry_id'] = $initialEnquiryId;
            $saved[] = ScheduleOfCare::create($schedule);
        }

        return $saved;
    }
}
