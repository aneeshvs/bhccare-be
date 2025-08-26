<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanPainManagement extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_pain_managements';

    protected $fillable = [
        'support_plan_id',
        'ongoing_pain',
        'pain_details',
        'pain_location',
        'pain_frequency',
        'pain_scale',
        'supported_for_pain',
        'supported_pain_details',
        'pain_management_strategies',
        'abbey_pain_scale_required',
        'pain_worry',
        'pain_worry_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_plan_pain_management');
    }
}
