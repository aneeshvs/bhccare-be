<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HomeSafetyOutsideEntry extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'outside_entries';


    protected $fillable = [
       'home_safety_checklist_assessment_id',
        'parking_adequate',
        'parking_adequate_strategy',
        'pathway_surface',
        'pathway_surface_strategy',
        'gates_entry_easy',
        'gates_entry_easy_strategy',
        'lighting_adequate',
        'lighting_adequate_strategy',
        'outdoor_fire_hazards',
        'outdoor_fire_hazards_strategy',
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
            ->useLogName('home_safety_outside_entry');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Home Safety Outside Entry record has been {$eventName}";
    }
}
