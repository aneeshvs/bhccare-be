<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCarePlanLocalServicesContact extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'plan_local_services_contacts';

    protected $fillable = [
        'support_care_plan_id',
        'council',
        'hospital',
        'electricity',
        'water',
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
            ->useLogName('support_care_plan_local_services_contacts');
    }
}
