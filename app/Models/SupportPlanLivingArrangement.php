<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanLivingArrangement extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'reside_in',
        'reside_with',
        'home_safety_assessment_date',
        'is_home_suitable',
        'home_suitable_details',
        'at_risk_of_homelessness',
        'homelessness_details',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'reside_in',
                'reside_with',
                'home_safety_assessment_date',
                'is_home_suitable',
                'home_suitable_details',
                'at_risk_of_homelessness',
                'homelessness_details',
                'support_plan_id',
            ])
            ->useLogName('support_plan_living_arrangement');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanLivingArrangement record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
