<?php

namespace App\ServiceAgreementService;

use App\Models\ServiceAgreement;

class ServiceAgreementCompletionService
{
    /**
     * List all fields to track completion progress.
     * KEY = Model or relationship name
     * VALUE = Fields to check
     */
    protected array $trackedFields = [

        // Fields on the main ServiceAgreement model
        'serviceAgreement' => [
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
            'representative_name',
            'representative_relationship',
            'representative_contact',
            'representative_email',
        ],

        // Related hasOne record (consent)
        'consent' => [
            'accepted_name',
            'accepted_position',
            'accepted_signature',
            'accepted_date',
            'consents_participant_name',
            'participant_role',
            'participant_signature',
            'participant_date',
            'witness_name',
            'witness_signature',
            'witness_date',
            'verbal_staff_name',
            'verbal_staff_signature',
            'verbal_staff_position',
            'verbal_date',
            'other_notes',
            'received_signed_copy',
            'agreed_verbally',
            'cms_comments_entered',
        ],
    ];

    public function calculate(ServiceAgreement $serviceAgreement): int
    {
        $filled = 0;
        $total  = 0;

        foreach ($this->trackedFields as $relation => $fields) {

            if ($relation === 'serviceAgreement') {
                // Count direct model fields
                foreach ($fields as $field) {
                    $total++;

                    if (!is_null($serviceAgreement->$field) && $serviceAgreement->$field !== '') {
                        $filled++;
                    }
                }

            } else {
                // Count relational fields (hasOne / hasMany)
                $related = $serviceAgreement->$relation;

                if ($related instanceof \Illuminate\Database\Eloquent\Collection) {

                    foreach ($related as $item) {
                        foreach ($fields as $field) {
                            $total++;
                            if (!is_null($item->$field) && $item->$field !== '') {
                                $filled++;
                            }
                        }
                    }

                } elseif ($related) {
                    foreach ($fields as $field) {
                        $total++;
                        if (!is_null($related->$field) && $related->$field !== '') {
                            $filled++;
                        }
                    }

                } else {
                    // related record not created yet → count fields as empty
                    $total += count($fields);
                }
            }
        }

        return $total > 0 ? (int) round(($filled / $total) * 100) : 0;
    }
}
