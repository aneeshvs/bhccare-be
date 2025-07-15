<?php
namespace App\OnboardingService;

use App\Models\ScheduleOfCare;

class ScheduleOfCareService
{
    public function saveMany(array $schedules, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($schedules as $schedule) {
            $saved[] = ScheduleOfCare::updateOrCreate(
                [
                    // 🎯 Unique identifying columns for update
                    'initial_enquiry_id' => $initialEnquiryId,

                ],
                array_merge($schedule, [
                    'initial_enquiry_id' => $initialEnquiryId,
                ])
            );
        }

        return $saved;
    }
}
