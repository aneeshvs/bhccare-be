<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ConfidentialInformationConsent extends DefaultDBModel
{
    use LogsActivity;

protected $table ='confidential_consents';

    protected $fillable = [
        'confidential_information_form_id',
        'signature',
        'signed_date',
        'signed_by',
        'name',
        'witnessed_by',
    ];

    public function form()
    {
        return $this->belongsTo(ConfidentialInformationForm::class, 'confidential_information_form_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('confidential_information_consent');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Confidential Information Consent was {$eventName}";
    }
}

