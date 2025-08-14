<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class NonResponseVisitPlan extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'telephone_home_or_mobile',
        'telephone_details',
        'contact_emergency_contact',
        'emergency_contact_details',
        'access_spare_key',
        'spare_key_details',
        'contact_other_persons',
        'other_persons_details',
        'contact_police_if_no_key',
        'police_contact_details',
        'access_key_lock',
        'key_lock_code',
        'key_lock_details',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('non_response_visit_plan');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "NonResponseVisitPlan record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
