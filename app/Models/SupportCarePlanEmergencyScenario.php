<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCarePlanEmergencyScenario extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'plan_emergency_scenarios';

    protected $fillable = [
        'support_care_plan_id',
        'admitted_to_hospital',
        'admitted_to_hospital_action',
        'medical_emergencies',
        'medical_emergencies_action',
        'other_likely_medical_emergency',
        'other_likely_medical_emergency_action',
        'natural_disaster',
        'natural_disaster_action',
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
            ->useLogName('support_care_plan_emergency_scenarios');
    }
}
