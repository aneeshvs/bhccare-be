<?php
namespace App\OnboardingService;

use App\Models\NdisGoals;

class NdisGoalServices
{
    public function saveMany(array $goal, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($goal as $goals) {
            if (!empty($goals['goal_description'])) {
                $saved[] = NdisGoals::updateOrCreate(
                    [
                        // 🎯 Uniqueness condition (change as needed)
                        'initial_enquiry_id' => $initialEnquiryId,
                        'goal_description' => $goals['goal_description'],
                    ],
                    [
                        // ✅ Data to update if match found
                        'goal_description' => $goals['goal_description'],
                    ]
                );
            }
        }

        return $saved;
    }
}
