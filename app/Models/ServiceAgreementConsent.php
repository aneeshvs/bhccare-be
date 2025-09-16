<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ServiceAgreementConsent extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'service_agreement_id',
        'accepted_name',
        'accepted_position',
        'accepted_signature',
        'accepted_date',
        'consents_participant_name',
        'participant_role',
        'participant_signature',
        'participant_date',
        'witness_name',
        'witness_signature',
        'witness_date',
        'verbal_staff_name',
        'verbal_staff_signature',
        'verbal_staff_position',
        'verbal_date',
        'other_notes',
        'received_signed_copy',
        'agreed_verbally',
        'cms_comments_entered',
    ];

    public function serviceAgreement()
    {
        return $this->belongsTo(ServiceAgreement::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('service_agreement_consent');
    }
}
