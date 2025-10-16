<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PreConsentDisclosure extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'confidential_information_form_id',
        'discuss_referral_services',
        'explain_release_agreement',
        'explain_share_without_consent',
        'provide_privacy_information',
    ];

    protected $casts = [
        'discuss_referral_services' => 'boolean',
        'explain_release_agreement' => 'boolean',
        'explain_share_without_consent' => 'boolean',
        'provide_privacy_information' => 'boolean',
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
            ->useLogName('pre_consent_disclosure');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Pre-Consent Disclosure record was {$eventName}";
    }
}
