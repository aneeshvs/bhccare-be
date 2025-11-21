<?php

namespace App\OnboardingPackingSignoffService;

use App\Models\OnboardingPackingSignoff;

class OnboardingPackingSignoffCompletionService
{
    /**
     * Define which fields are part of the completion logic.
     * You can add relationship fields here as needed.
     */
    private array $sectionFields = [
        'onboardingPackingSignoff' => [
            'service_agreement_provided',
        'service_agreement_date',
        'participant_handbook_provided',
        'participant_handbook_date',
        'support_care_plan_offered',
        'support_care_plan_date',
        'consent_form_signed',
        'consent_form_date',
        'feedback_form_provided',
        'feedback_form_date',
        'home_safety_check_conducted',
        'home_safety_check_date',
        'medication_consent_form',
        'medication_consent_date',
        'onboarding_form_completed',
        'onboarding_form_date',
        'risk_assessment_completed',
        'risk_assessment_date',
        'behaviour_support_plan_obtained',
        'behaviour_support_plan_date',
        'high_intensity_support_plan_obtained',
        'high_intensity_support_plan_date',
        'mealtime_plan_obtained',
        'mealtime_plan_date',
        'sil_occupancy_agreement_provided',
        'sil_occupancy_agreement_date',
        'external_provider_agreement_completed',
        'external_provider_agreement_date',
        'sda_residency_agreement_provided',
        'sda_residency_agreement_date',
        'sda_welcome_pack_provided',
        'sda_welcome_pack_date',
        'sda_residency_statement_provided',
        'sda_residency_statement_date',

        ],


     'disabilityActDiscussion'=>[
        'clarify_services_provided',
        'verbal_information_intake_process',
        'cost_of_services',
        'participant_rights_handbook'
     ],


        'participantDeclaration'=>[
        'participant_name',
        'relationship_to_participant',
        'participant_signature',
        'signed_date'
        ]

    ];

    /**
     * Calculate the completion percentage.
     */
    public function calculate(OnboardingPackingSignoff $record): int
    {
        $filledFields = 0;
        $totalFields = 0;

        foreach ($this->sectionFields as $relation => $fields) {

            // 1. Direct model fields
            if ($relation === 'onboardingPackingSignoff') {

                foreach ($fields as $field) {
                    $totalFields++;

                    if ($record->$field !== null && $record->$field !== '') {
                        $filledFields++;
                    }
                }

            } else {

                // 2. Handle relationships dynamically
                $relatedData = $record->$relation;

                if ($relatedData instanceof \Illuminate\Database\Eloquent\Collection) {

                    foreach ($relatedData as $row) {
                        foreach ($fields as $field) {
                            $totalFields++;

                            if ($row->$field !== null && $row->$field !== '') {
                                $filledFields++;
                            }
                        }
                    }

                } elseif ($relatedData) {

                    // Single related record
                    foreach ($fields as $field) {
                        $totalFields++;

                        if ($relatedData->$field !== null && $relatedData->$field !== '') {
                            $filledFields++;
                        }
                    }

                } else {

                    // Relation exists in schema, but no records yet
                    $totalFields += count($fields);
                }
            }
        }

        return $totalFields > 0
            ? (int) round(($filledFields / $totalFields) * 100)
            : 0;
    }
}
