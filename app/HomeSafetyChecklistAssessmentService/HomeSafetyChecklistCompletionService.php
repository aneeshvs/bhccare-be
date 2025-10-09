<?php

namespace App\HomeSafetyChecklistAssessmentService;

use App\Models\HomeSafetyChecklistAssessment;

class HomeSafetyChecklistCompletionService
{
    /**
     * Define which fields count toward completion.
     */
    private array $sectionFields = [
        'assessment' => [
            'participant_name',
            'address',
            'phone',
            'email',
            'is_new_participant',
            'is_review_existing',
            'does_participant_agree',
            'entry_door',
            'entry_door_other',

        ],

        'outsideEntry'=>[
            'parking_adequate',
        'parking_adequate_strategy',
        'pathway_surface',
        'pathway_surface_strategy',
        'gates_entry_easy',
        'gates_entry_easy_strategy',
        'lighting_adequate',
        'lighting_adequate_strategy',
        'outdoor_fire_hazards',
        'outdoor_fire_hazards_strategy',
        ],

        'insideResidence'=>[
            'exit_doors_unobstructed',
        'exit_doors_unobstructed_strategy',
        'heaters_suitable',
        'heaters_suitable_strategy',
        'aids_equipment_condition',
        'aids_equipment_condition_strategy',
        'evidence_of_pests',
        'evidence_of_pests_strategy',
        'participant_open_door',
        'participant_open_door_strategy',
        'fire_hazards',
        'fire_hazards_strategy',
        'vacuum_cleaner_ok',
        'vacuum_cleaner_ok_strategy',
        'mop_bucket_ok',
        'mop_bucket_ok_strategy',
        'step_ladder_ok',
        'step_ladder_ok_strategy',
        'cleaning_substances_ok',
        'cleaning_substances_ok_strategy',
        ],

        'hallways'=>[

        'hallways_lounge_dining_bedroom',
        'hallways_lounge_dining_bedroom_strategy',
        'pests_evidence',
        'pests_evidence_strategy',
        'lighting_workspace',
        'lighting_workspace_strategy',
        'furniture_stable',
        'furniture_stable_strategy',
        'bed_adjustable',
        'bed_adjustable_strategy',
        'electrical_switches',
        'electrical_switches_strategy',
        'private_sleep_space',
        'private_sleep_space_strategy',
        'fire_hazards',
        'fire_hazards_strategy',
        ],
       'hallwaysSafetyAssessment' =>[
        'floor_condition',
        'floor_condition_strategy',
        'electrical_condition',
        'electrical_condition_strategy',
        'ventilation_condition',
        'ventilation_condition_strategy',
        'bench_condition',
        'bench_condition_strategy',
        'stove_condition',
        'stove_condition_strategy',
        'fridge_condition',
        'fridge_condition_strategy',
        'bath_access',
        'bath_access_strategy',
        'toilet_access',
        'toilet_access_strategy',
        'privacy_condition',
        'privacy_condition_strategy',
        'laundry_condition',
        'laundry_condition_strategy',
        'ironing_condition',
        'ironing_condition_strategy',
        'manual_handling_risks',
        'manual_handling_strategy',
        'kitchen_fire_hazards',
        'kitchen_fire_hazards_strategy',
       ],






    ];

    /**
     * Calculate completion percentage dynamically.
     */
    public function calculate(HomeSafetyChecklistAssessment $assessment): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            if ($relation === 'assessment') {
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($assessment->$field)) {
                        $filledFields++;
                    }
                }
            } else {
                $relatedData = $assessment->$relation;

                if ($relatedData instanceof \Illuminate\Database\Eloquent\Collection) {
                    foreach ($relatedData as $item) {
                        foreach ($fields as $field) {
                            $totalFields++;
                            if (!empty($item->$field)) {
                                $filledFields++;
                            }
                        }
                    }
                } elseif ($relatedData) {
                    foreach ($fields as $field) {
                        $totalFields++;
                        if (!empty($relatedData->$field)) {
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
