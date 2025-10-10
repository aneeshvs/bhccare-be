<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class HomeSafetyMiscellaneous extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'home_miscellaneous';

    protected $fillable = [
        'home_safety_checklist_assessment_id',

        'misc_children_living_at_home',
        'misc_children_living_at_home_strategy',

        'misc_weapons_stored_appropriately',
        'misc_weapons_stored_appropriately_strategy',

        'misc_smoking_outside_only',
        'misc_smoking_outside_only_strategy',

        'misc_mobility_issues',
        'misc_mobility_issues_strategy',

        'misc_equipment_good_condition',
        'misc_equipment_good_condition_strategy',

        'misc_ppe_requirements',
        'misc_ppe_requirements_strategy',

        'misc_personal_threats',
        'misc_personal_threats_strategy',

        'misc_safe_neighbourhood',
        'misc_safe_neighbourhood_strategy',

        'misc_aggression_in_home',
        'misc_aggression_in_home_strategy',
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
            ->useLogName('home_safety_miscellaneous');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Home Safety Miscellaneous record has been {$eventName}";
    }
}
