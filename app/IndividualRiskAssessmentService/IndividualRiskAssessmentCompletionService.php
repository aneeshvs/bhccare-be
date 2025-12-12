<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessment;

class IndividualRiskAssessmentCompletionService
{
    /**
     * Define fields grouped by section/relation.
     * The `riskAssessment` section refers to fields directly on the IndividualRiskAssessment model.
     */
    private array $sectionFields = [

        'riskAssessment' => [
            'client_name',
            'site_address',
            'assessment_date',
            'planned_review_date',
        ],

        'details' =>[

        'vulnerability',
        'review_frequency',
        'dependent_on_homecare',

        ],

        'communications'=>[
        'hearing_impairment',
        'hearing_hazards',
        'hearing_management_plan',
        'speech_impairment',
        'speech_hazards',
        'speech_management_plan',
        ],

        'cognitions'=>[

        'oriented_in_time_place',
        'oriented_hazards',
        'oriented_management_plan',
        'accepts_direction',
        'direction_hazards',
        'direction_management_plan',
        'short_term_memory_issues',
        'memory_hazards',
        'memory_management_plan',
        ],

        'mobilities'=>[
            'walk_unaided',
        'accessibility_required',
        'walk_hazards',
        'walk_management_plan',

        'manages_stairs',
        'stairs_hazards',
        'stairs_management_plan',

        'uses_walking_aid',
        'walking_aid_hazards',
        'walking_aid_management_plan',

        'uses_wheelchair',
        'wheelchair_hazards',
        'wheelchair_management_plan',

        'bed_transfer',
        'bed_transfer_hazards',
        'bed_transfer_management_plan',

        'vehicle_transfer',
        'vehicle_transfer_hazards',
        'vehicle_transfer_management_plan',

        'toilet_transfer',
        'toilet_transfer_hazards',
        'toilet_transfer_management_plan',
        ],

        'personalCareSupport'=>[
        'showering', 'showering_hazards', 'showering_management_plan',
        'meal', 'meal_hazards', 'meal_management_plan',
        'toileting', 'toileting_hazards', 'toileting_management_plan',
        'grooming', 'grooming_hazards', 'grooming_management_plan',
        'repositioning_bed', 'repositioning_bed_hazards', 'repositioning_bed_management_plan',
        'repositioning_chair', 'repositioning_chair_hazards', 'repositioning_chair_management_plan',
        'mouthcare', 'mouthcare_hazards', 'mouthcare_management_plan',
        'skin_care', 'skin_care_hazards', 'skin_care_management_plan',
        ],

        'manualHandlings'=>[

         'training_provided',
        'training_hazards',
        'training_management_plan',
        'tasks_safe',
        'tasks_hazards',
        'tasks_management_plan',
        ],


       'violenceRisk' =>[

            'physical_aggression', 'physical_hazards', 'physical_management_plan', 'physical_bsp_plan',
        'verbal_aggression', 'verbal_aggression_notes', 'verbal_hazards', 'verbal_management_plan', 'verbal_bsp_plan',
        'client_aggression', 'client_hazards', 'client_management_plan', 'client_bsp_plan',
        'self_harm', 'self_harm_hazards', 'self_harm_management_plan', 'self_harm_bsp_plan',
        'drug_alcohol_use', 'drug_alcohol_hazards', 'drug_alcohol_management_plan', 'drug_alcohol_bsp_plan',
        'sexual_abuse_history', 'sexual_abuse_hazards', 'sexual_abuse_management_plan', 'sexual_abuse_bsp_plan',
        'emotional_manipulation', 'emotional_hazards', 'emotional_management_plan', 'emotional_bsp_plan',
        'other_known_risks', 'other_risks_hazards', 'other_risks_management_plan', 'other_risks_bsp_plan',
        'finance_management','finance_management_notes','finance_hazards', 'finance_management_plan', 'finance_bsp_plan',
        ]


    ];

    /**
     * Calculate percentage of completed fields.
     */
    public function calculate(IndividualRiskAssessment $assessment): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            if ($relation === 'riskAssessment') {
    foreach ($fields as $field) {
        $totalFields++;

        if ($assessment->$field !== null && $assessment->$field !== '') {
            $filledFields++;
        }
    }
} else {
    $relatedData = $assessment->$relation;

    if ($relatedData instanceof \Illuminate\Database\Eloquent\Collection) {
        foreach ($relatedData as $item) {
            foreach ($fields as $field) {
                $totalFields++;

                if ($item->$field !== null && $item->$field !== '') {
                    $filledFields++;
                }
            }
        }
    } elseif ($relatedData) {
        foreach ($fields as $field) {
            $totalFields++;

            if ($relatedData->$field !== null && $relatedData->$field !== '') {
                $filledFields++;
            }
        }
    } else {
        $totalFields += count($fields);
    }
}

        }

        return $totalFields > 0 ? (int) round(($filledFields / $totalFields) * 100) : 0;
    }
}
