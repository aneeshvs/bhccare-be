<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ServiceAgreement extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'staff_id',
        'user_id',
        'client_type',
        'participant_name',
        'ndis_number',
        'address',
        'contact',
        'email',
        'dob',
        'ndis_plan_start_date',
        'ndis_plan_end_date',
        'term_start_date',
        'term_end_date',
        'area_of_support',
        'representative_name',
        'representative_relationship',
        'representative_contact',
        'representative_email',
        'form_status',
        'completion_percentage',
    ];

    protected $attributes = [
        'form_status' => 'in_progress',
    ];

    protected $casts = [
    'area_of_support' => 'array',
];


    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('service_agreement');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Service Agreement record has been {$eventName}";
    }

    public function consent()
{
    return $this->hasOne(ServiceAgreementConsent::class);
}

}
