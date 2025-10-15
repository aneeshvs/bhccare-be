<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ConfidentialInformationForm extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'staff_id',
        'user_id',
        'client_type',
        'participant_name',
        'address',
        'post_code',
        'date_of_birth',
        'phone',
        'email',
        'mobile_no',
        'form_status',
        'completion_percentage',
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
            ->useLogName('confidential_information_form');
    }

    public function agencies()
{
    return $this->hasMany(ConfidentialInformationAgency::class);
}

public function consent()
{
    return $this->hasOne(ConfidentialInformationConsent::class, 'confidential_information_form_id');
}

public function verbal()
{
    return $this->hasOne(ConfidentialVerbalConsent::class,'confidential_information_form_id');
}




    public function getDescriptionForEvent(string $eventName): string
    {
        return "Confidential Information Form has been {$eventName}";
    }
}
