<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HomeSafetyChecklistAssessment extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'staff_id',
        'user_id',
        'client_type',
        'participant_name',
        'address',
        'phone',
        'email',
        'is_new_participant',
        'is_review_existing',
        'does_participant_agree',
        'entry_door',
        'entry_door_other',
        'form_status',
        'completion_percentage',
    ];


    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function outsideEntry()
{
    return $this->hasOne(HomeSafetyOutsideEntry::class, 'home_safety_checklist_assessment_id');
}

public function insideResidence()
    {
        return $this->hasOne(HomeSafetyInsideResidence::class, 'home_safety_checklist_assessment_id');
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('home_safety_checklist_assessment');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Home Safety Checklist Assessment record has been {$eventName}";
    }
}
