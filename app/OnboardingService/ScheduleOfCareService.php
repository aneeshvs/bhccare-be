<?php
namespace App\OnboardingService;

use App\Models\ScheduleOfCare;

class ScheduleOfCareService
{
    public function saveMany(array $schedules, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($schedules as $schedule) {
            // Skip if empty type
            if (empty($schedule['type_of_service'])) {
                continue;
            }

            $saved[] = ScheduleOfCare::updateOrCreate(
                [
                    'initial_enquiry_id' => $initialEnquiryId,
                    'type_of_service' => $schedule['type_of_service'], // ✅ now uniquely identifies record
                ],
                array_merge($schedule, [
                    'initial_enquiry_id' => $initialEnquiryId,
                ])
            );
        }

        return $saved;
    }
}
