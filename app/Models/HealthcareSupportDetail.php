<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HealthcareSupportDetail extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'medicare',
        'health_fund',
        'pension_card_number',
        'health_care_card',
        'dva_type',
        'dva_number',
        'companion_card',
        'preferred_hospital',
        'ambulance_number',
        'disabled_parking',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Activity Log Options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('healthcare_support_detail');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "HealthcareSupportDetail record has been {$eventName}";
    }
}
