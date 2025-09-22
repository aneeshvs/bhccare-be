<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCarePlanEmergencyContact extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'plan_emergency_contacts';

    protected $fillable = [
        'support_care_plan_id',
        'goal_key',
        'name',
        'relationship',
        'phone',
        'email',
        'location',
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
            ->useLogName('support_care_plan_emergency_contacts');
    }
}
