<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanContactDetail extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'phone',
        'address',
        'is_rural_area', // boolean: 1 = Yes, 0 = No
        'mailing_address',
        'email',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('support_plan_contact_detail');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanContactDetail record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
