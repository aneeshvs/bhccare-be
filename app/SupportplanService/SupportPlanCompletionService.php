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
