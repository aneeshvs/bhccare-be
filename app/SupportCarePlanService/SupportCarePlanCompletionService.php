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

        'alternateDecisionMaker'=>[
        'type',
        'first_name',
        'surname',
        'notes',
        ],

        'silGoals'=>[

        'goal_title',
        'goals_of_support',
        'steps',
        'organisation_steps',
        'risk',
        'risk_management_strategies',

    ],


        'communicationPlans'=>[
            'helps_me_talk',
        'helps_me_understand',
        'please_communicate_by',
        'emergency_communication'
        ],


        'emergencyDisasterPlan'=>[
        'participant_name',
        'date',
        'review_date',
        ],

        'emergencyContacts'=>[
             'name',
        'relationship',
        'phone',
        'email',
        'location',
        ],

         'importantContacts'=>[
            'advocate',
        'childcare_school_contact',
        'power_of_attorney_guardian',
        'workplace_volunteer_contact',
        'landlord_sda_provider',
        'doctor',
        'specialist_practitioner',
        'solicitor',
        'insurer_home_contents',
        'private_health_cover',
        'insurer_vehicle',
         ],

    'localServicesContact'=>[
         'council',
        'hospital',
        'electricity',
        'water',
    ],


    'emergencyScenario'=>[

        'admitted_to_hospital',
        'admitted_to_hospital_action',
        'medical_emergencies',
        'medical_emergencies_action',
        'other_likely_medical_emergency',
        'other_likely_medical_emergency_action',
        'natural_disaster',
        'natural_disaster_action',

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

                // Count filled including boolean 0 or 1
                if ($plan->$field !== null && $plan->$field !== '') {
                    $filledFields++;
                }
            }

        } else {

            $relatedData = $plan->$relation;

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
