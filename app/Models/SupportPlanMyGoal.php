<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanMyGoal extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'goal',
        'goal_key',
        'measure_progress',
        'success_look_like',
        'who_will_support',
        'participant_support',
        'target_date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('support_plan_my_goal');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanMyGoal record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
