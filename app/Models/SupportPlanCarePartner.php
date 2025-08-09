<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanCarePartner extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'care_partner_name',
        'care_partner_role',
        'care_partner_contact_phone',
        'care_partner_email',

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'care_partner_name',
                'care_partner_role',
                'care_partner_contact_phone',
                'care_partner_email',
                'support_plan_id',
            ])
            ->useLogName('support_plan_care_partner');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanCarePartner record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
