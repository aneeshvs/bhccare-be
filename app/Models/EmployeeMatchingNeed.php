<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class EmployeeMatchingNeed extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'cultural_considerations',
        'specific_training_required',
        'common_interests',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'support_plan_id',
                'cultural_considerations',
                'specific_training_required',
                'common_interests',
            ])
            ->useLogName('employee_matching_need');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "EmployeeMatchingNeed record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
