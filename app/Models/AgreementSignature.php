<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AgreementSignature extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'schedule_of_support_id',
        'participant_signature',
        'agreement_participant_name',
        'participant_date',
        'representative_signature',
        'representative_name',
        'representative_date',
    ];

    public function scheduleOfSupport()
    {
        return $this->belongsTo(ScheduleOfSupport::class, 'schedule_of_support_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('agreement_signature');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "AgreementSignature record has been {$eventName}";
    }
}
