<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ParticipantSignature extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'staff_id',
        'user_id',
        'client_type',
        'participant_signature',
        'date_signed',
        'form_status',
        'completion_percentage',
    ];

    

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('participant_signature');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Participant signature record has been {$eventName}";
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
