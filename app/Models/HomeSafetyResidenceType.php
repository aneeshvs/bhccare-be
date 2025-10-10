<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HomeSafetyResidenceType extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'home_residence_types';

    protected $fillable = [
        'home_safety_checklist_assessment_id',
        'residence_house_type',
        'residence_other_type',
       
        'assessment_completed_with',
        'name',
        'position',
        'review_date',
        'care_facility',
    ];

    public function homeSafety()
    {
        return $this->belongsTo(HomeSafetyChecklistAssessment::class, 'home_safety_checklist_assessment_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('home_safety_residence_type');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Home Safety Residence Type record has been {$eventName}";
    }
}
