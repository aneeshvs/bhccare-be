<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanEndOfLifeAdvancedCarePlanning extends DefaultDBModel
{
    protected $table = 'support_plan_end_of_life_advanced_care_plannings';

    protected $fillable = [
        'support_plan_id',
        'receiving_palliative_care',
        'receiving_palliative_care_details',
        'support_to_initiate_palliative_care',
        'support_to_initiate_palliative_care_details',
        'has_advanced_care_plan',
        'advanced_care_plan_details',
        'support_to_complete_advanced_care_plan',
        'support_to_complete_advanced_care_plan_details',
        'has_dnr',
        'dnr_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class, 'support_plan_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('support_plan_end_of_life_advanced_care_planning')
            ->logFillable()
            ->logOnlyDirty();
    }
}
