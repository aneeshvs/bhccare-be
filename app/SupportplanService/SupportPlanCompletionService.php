<?php

namespace App\SupportplanService;

use App\Models\SupportPlan;

class SupportPlanCompletionService
{
    /**
     * Define fields grouped by section/relation.
     * The `supportPlan` section refers to fields directly on the SupportPlan model.
     */
    private array $sectionFields = [
        'supportPlan' => [
            'effective_date',
            'review_date',
            'confirmation_date',
            'developed_by',
            'invited_but_not_participated',
            'staff_id',
        ],

        'approval' => [
            'participant_name',
            'date_of_approval',
            'signature',
        ],

        'representativeApproval' => [
            'representative_name',
            'role',
            'representative_date_of_approval',
        ],

        'careApproval' => [
            'care_partner_name',
            'care_partner_role',
            'care_partner_contact_phone',
            'care_partner_email',
        ],
        'keep_in_touch' =>[
            'need_help_to_communicate',
            'type_of_difficulty',
            'contact_first_instance',
            'details',
            'language_spoken',
            'use_nrs',
            'require_interpreter',
            'written',
            'verbal',
            'schedule_change_notification',
            'interpreter_arrangement',
            'financial_statement_method',
            'feedback_survey_method',
            'marketing_material_method',
            'preferred_communication_method',
            'join_cab',
        ],

        'non_responsive'=>[

        'telephone_home_or_mobile',
        'telephone_details',
        'contact_emergency_contact',
        'emergency_contact_details',
        'access_spare_key',
        'spare_key_details',
        'contact_other_persons',
        'other_persons_details',
        'contact_police_if_no_key',
        'police_contact_details',
        'access_key_lock',
        'key_lock_code',
        'key_lock_details',
        ],
       'participantDetail'=>[
        'first_name',
        'surname',
        'preferred_name',
        'date_of_birth',
        'country_of_birth',
        'identify_as_aboriginal_or_torres_strait',
        'gender',
       ],
       'contactDetail'=>[
        'phone',
        'address',
        'is_rural_area',
        'mailing_address',
        'email',
       ],
       'contactDetailSecondary'=>[
        'secondary_role',
        'secondary_phone',
        'secondary_email',
        'secondary_address',
        'secondary_best_time_to_contact',
        'secondary_is_mac_registered',
        'secondary_list_documents',
        'secondary_legal_documentation_stored',
        'secondary_date_legal_orders_end',
        'secondary_participants_agreed_contact',
        'secondary_participants_agreed_contact_date',
        'secondary_decision_making_approval_for',

       ],
       'SupportFunding'=>[
        'aged_care_id',
        'pension_status',
        'pension_card_details',
        'card_number',
        'card_expiry',
        'approved_funding_level',
        'awaiting_package_upgrade',
        'upgrade_details',
        'has_chsp_referral_codes',
        'chsp_referral_details',
        'war_veteran_or_widow',
        'dva_number',
        'medicare_number',
        'private_health_insurance',
        'hcp_funding_level',
        'has_companion_card',
       ],
       'services'=>[
            'name',
            'service_provided',
            'funded_by',
            'duration_frequency',
            'support_to_implement_by_us',
       ],
       'supportplan_employee'=>[
        'cultural_considerations',
        'specific_training_required',
        'common_interests',
       ],
       'myGoals'=>[
         'goal',
        'measure_progress',
        'success_look_like',
        'who_will_support',
        'participant_support',
        'target_date',
       ],

      'LivingArrangement'=>[

        'reside_in',
        'reside_with',
        'home_safety_assessment_date',
        'is_home_suitable',
        'home_suitable_details',
        'at_risk_of_homelessness',
        'homelessness_details',
      ],
      'cultural_diversity'=>[
        'is_lgbti',
        'lgbti_details',
        'is_separated_family',
        'separated_family_details',
        'has_cultural_events',
        'cultural_events_details',
        'has_past_events',
        'past_events_details',
        'has_non_disclosure_items',
        'non_disclosure_details',
      ],
      'general_health'=>[
          'gp_visit_frequency',
        'admitted_hospital_last12months',
        'admitted_hospital_details',
        'preferred_hospital',
        'preferred_hospital_details',
        'diagnosis_medication_conditions',
        'previous_surgeries',
        'has_allergies',
        'allergy_details',
        'health_impact_scale',
        'painful_day_to_day',
        'painful_day_to_day_details',
        'weight_loss_last3months',
        'weight_loss_details',
        'nutritional_concerns',
        'nutritional_concerns_details',
        'current_weight',
        'annual_vaccinations',
        'annual_vaccination_details',
        'last_influenza_vaccine',
        'last_covid19_vaccine',
        'last_pneumonia_vaccine',
        'sleep_difficulties',
        'sleep_difficulties_details',
        'sleep_routine',
        'sleep_routine_worries',
        'sleep_routine_worries_details',
        'alcohol_smoke_drug_use',
        'alcohol_smoke_drug_details',
        'alcohol_smoke_drug_worries',
        'alcohol_smoke_drug_worries_details',
        'referral_required',
        'referral_required_details',
      ],

      'medication_management'=>[
        'takes_regular_medications',
        'medication_details',
        'medication_form',
        'medication_packaging',
        'medications_locked',
        'medications_locked_details',
        'specific_storage_requirements',
        'scheduled_4_or_8_medications',
        'scheduled_medications_details',
        'chemical_restraint_medications',
        'takes_more_than_prescribed',
        'takes_more_than_prescribed_details',
        'at_risk_of_missing_medication',
        'missing_medication_details',
        'able_to_explain_purpose',
        'last_medication_review_date',
        'medication_collection_delivery_details',
        'needs_support_with_medication',
        'support_with_medication_details',
        'medication_management_worries',
        'medication_management_worries_details',
        'medication_service_required',
        'support_worker_prompt',
      ],

      'mobility_transfer'=>[
        'can_walk_independently',
        'walk_independently_details',
        'needs_transfer_support',
        'primary_equipment_used',
        'can_climb_stairs',
        'climb_stairs_details',
        'has_stairs_at_home',
        'stairs_at_home_details',
        'can_transfer_self',
        'can_transfer_in_other_envs',
        'uses_bed_pole_or_rails',
        'bed_pole_prescribed_by_ot',
        'can_access_places_outside_walking_distance',
        'access_places_details',
        'safe_to_mobilise_in_yard',
        'mobilise_yard_details',
        'community_access',
        'drives',
        'medications_or_conditions_risk',
        'driving_risk_details',
        'mobility_equipment',
        'equipment_purchase_type',
        'uses_four_wheel_walker',
        'four_wheel_walker_details',
        'wheelchair_type',
        'wheelchair_operation',
        'wheelchair_ot_recommended',
        'can_charge_wheelchair',
        'last_wheelchair_service_date',
        'can_carry_5kg',
        'carry_5kg_details',
        'foot_problems',
        'foot_problems_details',
        'mobility_worries',
        'mobility_worries_details',
        'last_ot_assessment_date',
        'new_ot_referral_required',
        'demmi_assessment_required',
        'demmi_assessment_result',
      ]

    ];
    /**
     * Calculate percentage of completed fields.
     */
    public function calculate(SupportPlan $supportPlan): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            if ($relation === 'supportPlan') {
                  // Fields directly on the SupportPlan model
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($supportPlan->$field)) {
                        $filledFields++;
                    }
                }
            } else {
                // Related models (approval, representative, carePartner)
                $relatedData = $supportPlan->$relation;

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
                    // Relation is empty, so count all fields as unfilled
                    $totalFields += count($fields);
                }
            }
        }

        return $totalFields > 0 ? (int) round(($filledFields / $totalFields) * 100) : 0;
    }
}
