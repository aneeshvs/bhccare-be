<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCoordinationGoal extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_coordination_goals';

    protected $fillable = [
        'support_care_plan_id',
        'goal_key',
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

    // ✅ Spatie log options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('support_coordination_goals');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportCoordinationGoal record has been {$eventName}";
    }
}
