<?php

namespace App\ServiceAgreementService;

use App\Models\ServiceAgreement;

class ServiceAgreementCompletionService
{
    /**
     * Define fields grouped by section/relation.
     * The `serviceAgreement` section refers to fields directly on the ServiceAgreement model.
     */
    private array $sectionFields = [
        'serviceAgreement' => [
            // Participant fields
            'participant_name',
            'ndis_number',
            'address',
            'contact',
            'email',
            'dob',
            'ndis_plan_start_date',
            'ndis_plan_end_date',
            'term_start_date',
            'term_end_date',
            'area_of_support',

            // Representative fields
            'representative_name',
            'representative_relationship',
            'representative_contact',
            'representative_email',

            // System / meta fields
            'staff_id',
            'user_id',
            'client_type',
        ],
    ];

    /**
     * Calculate percentage of completed fields.
     */
    public function calculate(ServiceAgreement $serviceAgreement): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            if ($relation === 'serviceAgreement') {
                // Fields directly on the ServiceAgreement model
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($serviceAgreement->$field)) {
                        $filledFields++;
                    }
                }
            }
        }

        return $totalFields > 0 ? (int) round(($filledFields / $totalFields) * 100) : 0;
    }
}
