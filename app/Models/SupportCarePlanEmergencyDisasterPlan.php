<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCarePlanEmergencyDisasterPlan extends DefaultDBModel
{
    use LogsActivity;
    protected $table='emergency_disaster_plans';

    protected $fillable = [
        'support_care_plan_id',
        'participant_name',
        'date',
        'review_date',
    ];

    public function supportCarePlan()
    {
        return $this->belongsTo(SupportCarePlan::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_care_plan_emergency_disaster');
    }
}
