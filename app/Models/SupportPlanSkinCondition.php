<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanSkinCondition extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_skin_conditions';

    protected $fillable = [
        'support_plan_id',
        'has_skin_condition',
        'skin_condition_type',
        'impacts_daily_activities',
        'impact_date',
        'pain_discomfort_level',
        'pain_level_score',
        'management_strategies',
        'skin_condition_worry',
        'worry_date',
        'referral_nursing_required',
        'referral_nursing_date',
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
            ->useLogName('support_plan_skin_condition');
    }
}
