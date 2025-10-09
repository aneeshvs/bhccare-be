<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HallwaysSafetyCheck extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'hallways_checks';

    protected $fillable = [
        'home_safety_checklist_assessment_id',
        'hallways_lounge_dining_bedroom',
        'hallways_lounge_dining_bedroom_strategy',
        'pests_evidence',
        'pests_evidence_strategy',
        'lighting_workspace',
        'lighting_workspace_strategy',
        'furniture_stable',
        'furniture_stable_strategy',
        'bed_adjustable',
        'bed_adjustable_strategy',
        'electrical_switches',
        'electrical_switches_strategy',
        'private_sleep_space',
        'private_sleep_space_strategy',
        'hallways_fire_hazards',
        'hallways_fire_hazards_strategy',
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
            ->useLogName('hallways_safety_check');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Hallways Safety Check record has been {$eventName}";
    }
}
