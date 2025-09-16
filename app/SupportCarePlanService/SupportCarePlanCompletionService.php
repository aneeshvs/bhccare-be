<?php

namespace App\SupportCarePlanService;

use App\Models\SupportCarePlan;

class SupportCarePlanCompletionService
{
    /**
     * Define fields grouped by section/relation.
     * The `supportCarePlan` section refers to fields directly on the SupportCarePlan model.
     */
    private array $sectionFields = [
        'supportCarePlan' => [
            // Participant details
            'consents_participant_first_name',
            'consents_participant_surname',
            'consents_participant_dob',
            'consents_goal_plan_start_date',
            'consents_goal_plan_review_date',
        ],
    ];

    /**
     * Calculate percentage of completed fields.
     */
    public function calculate(SupportCarePlan $plan): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            if ($relation === 'supportCarePlan') {
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($plan->$field)) {
                        $filledFields++;
                    }
                }
            }
        }

        return $totalFields > 0 ? (int) round(($filledFields / $totalFields) * 100) : 0;
    }
}
