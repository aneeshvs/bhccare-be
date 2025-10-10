<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OutsideResidenceAssessment extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'outside_assessments';

    protected $fillable = [
        'home_safety_checklist_assessment_id',

        'outside_paths_veranda_steps',
        'outside_paths_veranda_steps_strategy',

        'outside_pets_restrained',
        'outside_pets_restrained_strategy',

        'outside_lighting_adequate',
        'outside_lighting_adequate_strategy',

        'outside_door_easy_open',
        'outside_door_easy_open_strategy',

        'outside_lawn_mower_condition',
        'outside_lawn_mower_condition_strategy',

        'outside_electrical_condition',
        'outside_electrical_condition_strategy',

        'outside_fire_hazards',
        'outside_fire_hazards_strategy',
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
            ->useLogName('outside_residence_assessment');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Outside Residence Assessment record has been {$eventName}";
    }
}
