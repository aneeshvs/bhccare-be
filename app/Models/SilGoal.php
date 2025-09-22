<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SilGoal extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_care_plan_id',
        'goal_key',
        'category',
        'goal_title',
        'goals_of_support',
        'steps',
        'organisation_steps',
        'risk',
        'risk_management_strategies',
    ];

    public function supportCarePlan()
    {
        return $this->belongsTo(SupportCarePlan::class, 'support_care_plan_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('sil_goals');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SilGoal record has been {$eventName}";
    }
}
