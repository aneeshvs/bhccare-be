<?php

namespace App\ConfidentialInformationFormService;

use App\Models\ConfidentialInformationForm;

class ConfidentialInformationFormCompletionService
{
    /**
     * Define which fields count toward completion.
     */
    private array $sectionFields = [
        'form' => [
            'participant_name',
            'address',
            'post_code',
            'date_of_birth',
            'phone',
            'email',
            'mobile_no',
        ],

        'agencies'=>[

        'name',
        'role',
        'contact',
        'agency_name',
        'service_type',
        'information_shared',
        ],

        'consent'=>[
            'signature',
        'signed_date',
        'signed_by',
        'name',
        'witnessed_by',
        ],

        'verbal'=>[

        'verbal_signature',
        'verbal_signed_date',
        'verbal_name',
        'position',
        ],



        'preConsentDisclosure'=>[

        'discuss_referral_services',
        'explain_release_agreement',
        'explain_share_without_consent',
        'provide_privacy_information',
        ]



    ];

    /**
     * Calculate completion percentage dynamically.
     */
    public function calculate(ConfidentialInformationForm $form): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $section => $fields) {
            if ($section === 'form') {
                // Direct form fields
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($form->$field)) {
                        $filledFields++;
                    }
                }
            } else {
                // Handle related models if added in future
                $relatedData = $form->$section;

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
