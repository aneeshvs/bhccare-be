<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessment;

class IndividualRiskAssessmentCompletionService
{
    /**
     * Define fields grouped by section/relation.
     * The `riskAssessment` section refers to fields directly on the IndividualRiskAssessment model.
     */
    private array $sectionFields = [
        'riskAssessment' => [
            'client_name',
            'site_address',
            'assessment_date',
            'planned_review_date',
        ],


    ];

    /**
     * Calculate percentage of completed fields.
     */
    public function calculate(IndividualRiskAssessment $assessment): int
    {
        $filledFields = 0;
        $totalFields  = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            if ($relation === 'riskAssessment') {
                // Direct fields on IndividualRiskAssessment
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($assessment->$field)) {
                        $filledFields++;
                    }
                }
            } else {
                // Handle hasOne / hasMany relations if added
                $relatedData = $assessment->$relation;

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
                    // If no related records exist, count fields as empty
                    $totalFields += count($fields);
                }
            }
        }

        return $totalFields > 0 ? (int) round(($filledFields / $totalFields) * 100) : 0;
    }
}
