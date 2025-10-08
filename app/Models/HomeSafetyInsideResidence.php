<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HomeSafetyInsideResidence extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'inside_residences';

    protected $fillable = [
        'home_safety_checklist_assessment_id',
        'exit_doors_unobstructed',
        'exit_doors_unobstructed_strategy',
        'heaters_suitable',
        'heaters_suitable_strategy',
        'aids_equipment_condition',
        'aids_equipment_condition_strategy',
        'evidence_of_pests',
        'evidence_of_pests_strategy',
        'participant_open_door',
        'participant_open_door_strategy',
        'fire_hazards',
        'fire_hazards_strategy',
        'vacuum_cleaner_ok',
        'vacuum_cleaner_ok_strategy',
        'mop_bucket_ok',
        'mop_bucket_ok_strategy',
        'step_ladder_ok',
        'step_ladder_ok_strategy',
        'cleaning_substances_ok',
        'cleaning_substances_ok_strategy',
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
            ->useLogName('home_safety_inside_residence');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Home Safety Inside Residence record has been {$eventName}";
    }
}
