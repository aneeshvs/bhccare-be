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
