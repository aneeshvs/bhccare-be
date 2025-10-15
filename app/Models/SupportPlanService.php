<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanService extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'name',
        'goal_key',
        'service_provided',
        'funded_by',
        'duration_frequency',
        'support_to_implement_by_us',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('support_plan_service');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanService record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
