<?php

namespace App\SupportplanService;

use App\Models\SupportPlan;

class SupportPlanCompletionService
{
    protected array $fields = [
        'effective_date',
        'review_date',
        'confirmation_date',
        'developed_by',
        'invited_but_not_participated',
        'staff_id',
    ];

    public function calculate(SupportPlan $supportPlan): int
    {
        $filled = 0;
        $total = count($this->fields);

        foreach ($this->fields as $field) {
            if (!empty($supportPlan->$field)) {
                $filled++;
            }
        }

        return $total > 0 ? (int) round(($filled / $total) * 100) : 0;
    }
}
