<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FundingDetail extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'type_of_funding',
        'funding_contact_person',
        'ndis_plan_attached',
        'ndis_plan_start_date',
        'ndis_plan_end_date',
        'plan_manager_name',
        'plan_manager_email',
        'plan_manager_phone'
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Activity Log Settings
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('funding_detail');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "FundingDetail record has been {$eventName}";
    }
}
