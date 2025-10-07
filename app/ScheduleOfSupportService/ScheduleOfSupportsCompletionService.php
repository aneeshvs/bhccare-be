<?php

namespace App\ScheduleOfSupportService;

use App\Models\ScheduleOfSupport;

class ScheduleOfSupportsCompletionService
{
    /**
     * Define fields grouped by section/relation.
     * The `schedule` section refers to fields directly on the ScheduleOfSupports model.
     */
    private array $sectionFields = [

        'schedule' => [
           'participant_name',
            'creation_date',
            'funding_review_date',
            'support_on_public_holiday',
        ],
        'transport'=>[
            'support_name',
            'description',
            'price',
            'payment_information',
            'invoicing_details',
            'delivery_details',
            'grand_total',
        ],

        'unfundedSupport'=>[

        'unfunded_support_name',
        'unfunded_description',
        'unfunded_price_information',
        'unfunded_delivery_details',
        'unfunded_price',
        'unfunded_grand_total',

        ],

        'agreementSignature' =>[

        'participant_signature',
        'agreement_participant_name',
        'participant_date',
        'homecare_signature',
        'homecare_name',
        'homecare_date',
        ],

    ];

    /**
     * Calculate percentage of completed fields.
     */
    public function calculate(ScheduleOfSupport $schedule): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            if ($relation === 'schedule') {
                // Direct fields on ScheduleOfSupports
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($schedule->$field) || $schedule->$field === 0) {
                        $filledFields++;
                    }
                }
            } else {
                // Future extension: related tables
                $relatedData = $schedule->$relation;

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
