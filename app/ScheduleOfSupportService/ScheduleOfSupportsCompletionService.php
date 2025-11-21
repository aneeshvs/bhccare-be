<?php

namespace App\ScheduleOfSupportService;

use App\Models\ScheduleOfSupport;

class ScheduleOfSupportsCompletionService
{
    private array $sectionFields = [

        // Main Table Fields
        'schedule' => [
            'participant_name',
            'creation_date',
            'funding_review_date',
            'support_on_public_holiday',
        ],

        // Funded supports (relation name must match model relationship)
        'transport' => [
            'support_name',
            'description',
            'price',
            'payment_information',
            'invoicing_details',
            'delivery_details',
            'grand_total',
        ],

        // Unfunded supports (relation)
        'unfundedSupport' => [
            'unfunded_support_name',
            'unfunded_description',
            'unfunded_price_information',
            'unfunded_delivery_details',
            'unfunded_price',
            'unfunded_grand_total',
        ],

        // Final signature section
        'agreementSignature' => [
            'participant_signature',
            'agreement_participant_name',
            'participant_date',
            'representative_signature',
            'representative_name',
            'representative_date',
        ],
    ];

    public function calculate(ScheduleOfSupport $schedule): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {

            if ($relation === 'schedule') {
                // Direct attributes
                foreach ($fields as $field) {
                    $totalFields++;
                    if ($schedule->$field !== null && $schedule->$field !== '') {
                        $filledFields++;
                    }
                }

            } else {

                $relatedData = $schedule->$relation;

                // Collection type relations
                if ($relatedData instanceof \Illuminate\Database\Eloquent\Collection) {
                    foreach ($relatedData as $item) {
                        foreach ($fields as $field) {
                            $totalFields++;
                            if ($item->$field !== null && $item->$field !== '') {
                                $filledFields++;
                            }
                        }
                    }

                // Single-object relation
                } elseif ($relatedData) {
                    foreach ($fields as $field) {
                        $totalFields++;
                        if ($relatedData->$field !== null && $relatedData->$field !== '') {
                            $filledFields++;
                        }
                    }

                } else {
                    // If relation doesn't exist yet, count empty fields
                    $totalFields += count($fields);
                }
            }
        }

        return $totalFields > 0 ? (int) round(($filledFields / $totalFields) * 100) : 0;
    }
}
