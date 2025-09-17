<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCarePlan extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'staff_id',
        'client_type',
        'consents_participant_first_name',
        'consents_participant_surname',
        'consents_participant_dob',
        'consents_goal_plan_start_date',
        'consents_goal_plan_review_date',
        'form_status',
        'completion_percentage',
    ];

    protected $attributes = [
        'form_status' => 'in_progress',
        'completion_percentage' => 0,
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_care_plan');
    }

    public function alternateDecisionMaker()
{
    return $this->hasOne(AlternateDecisionMaker::class);
}

public function silGoals()
    {
        return $this->hasMany(SilGoal::class, 'support_care_plan_id')
                    ->where('category', 'sil');
    }

    // Support Coordination Goals
    public function supportCoordinationGoals()
    {
        return $this->hasMany(SilGoal::class, 'support_care_plan_id')
                    ->where('category', 'support_coordination');
    }

    // Homecare Goals
    public function homecareGoals()
    {
        return $this->hasMany(SilGoal::class, 'support_care_plan_id')
                    ->where('category', 'homecare');
    }

// public function supportCoordinationGoals()
// {
//     return $this->hasMany(SupportCoordinationGoal::class, 'support_care_plan_id');
// }



}
