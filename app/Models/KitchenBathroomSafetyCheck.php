<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class KitchenBathroomSafetyCheck extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'kitchen_asessments';

    protected $fillable = [
        'home_safety_checklist_assessment_id',
        'floor_condition',
        'floor_condition_strategy',
        'electrical_condition',
        'electrical_condition_strategy',
        'ventilation_condition',
        'ventilation_condition_strategy',
        'bench_condition',
        'bench_condition_strategy',
        'stove_condition',
        'stove_condition_strategy',
        'fridge_condition',
        'fridge_condition_strategy',
        'bath_access',
        'bath_access_strategy',
        'toilet_access',
        'toilet_access_strategy',
        'privacy_condition',
        'privacy_condition_strategy',
        'laundry_condition',
        'laundry_condition_strategy',
        'ironing_condition',
        'ironing_condition_strategy',
        'manual_handling_risks',
        'manual_handling_strategy',
        'kitchen_fire_hazards',
        'kitchen_fire_hazards_strategy',
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
            ->useLogName('kitchen_bathroom_safety_check');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Kitchen / Bathroom Safety Check record has been {$eventName}";
    }
}
