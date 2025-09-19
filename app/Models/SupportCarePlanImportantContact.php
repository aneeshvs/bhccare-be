<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCarePlanImportantContact extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'plan_important_contacts';

    protected $fillable = [
        'support_care_plan_id',
        'advocate',
        'childcare_school_contact',
        'power_of_attorney_guardian',
        'workplace_volunteer_contact',
        'landlord_sda_provider',
        'doctor',
        'specialist_practitioner',
        'solicitor',
        'insurer_home_contents',
        'private_health_cover',
        'insurer_vehicle',
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
            ->useLogName('support_care_plan_important_contacts');
    }
}
