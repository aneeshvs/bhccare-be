<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ConfidentialVerbalConsent extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'verbal_consents';

    protected $fillable = [
        'confidential_information_form_id',
        'verbal_signature',
        'signed_date',
        'verbal_name',
        'position',
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
            ->useLogName('confidential_verbal_consent');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Confidential Verbal Consent was {$eventName}";
    }
}
