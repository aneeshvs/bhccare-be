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
        'enter_home_with_spare_key',
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
