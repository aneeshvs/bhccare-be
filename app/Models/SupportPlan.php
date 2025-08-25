<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlan extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [

        'user_id',
        'staff_id',
        'client_type',
        'effective_date',
        'review_date',
        'confirmation_date',
        'developed_by',
        'invited_but_not_participated',
        'form_status',
    ];

    protected $attributes = [
        'form_status' => 'in_progress',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'effective_date', 'review_date', 'confirmation_date',
                'developed_by', 'invited_but_not_participated',
                'user_id', 'client_type', 'form_status'
            ])
            ->useLogName('support_plan');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlan record has been {$eventName}";
    }
    // In App\Models\SupportPlan.php
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
        public function approval()
    {
        return $this->hasOne(SupportPlanApproval::class);
    }
        public function representativeApproval()
    {
        return $this->hasOne(SupportPlanRepresentative::class);
    }
    public function careApproval()
    {
        return $this->hasOne(SupportPlanCarePartner::class);
    }
    public function keep_in_touch()
    {
        return $this->hasOne(KeepingInTouch::class);
    }
    public function non_responsive()
    {
        return $this->hasOne(NonResponseVisitPlan::class);
    }
    public function participantDetail()
    {
        return $this->hasOne(ParticipantDetail::class);
    }
        public function contactDetail()
    {
        return $this->hasOne(SupportPlanContactDetail::class);
    }
        public function contactDetailSecondary()
    {
        return $this->hasOne(SupportPlanContactDetailSecondary::class);
    }
    public function SupportFunding()
    {
        return $this->hasOne(SupportPlanFunding::class);
    }

            public function services()
    {
        return $this->hasMany(SupportPlanService::class, 'support_plan_id');
    }
    public function supportplan_employee()
    {
        return $this->hasOne(EmployeeMatchingNeed::class);
    }

        public function myGoals()
    {
        return $this->hasMany(SupportPlanMyGoal::class, 'support_plan_id');
    }
    public function LivingArrangement()
    {
        return $this->hasOne(SupportPlanLivingArrangement::class);
    }

    public function  cultural_diversity()
    {
        return $this->hasOne(CulturalDiversity::class);


    }
        public function general_health()
    {
        return $this->hasOne(SupportPlanGeneralHealth::class);
    }

    public function medication_management()
    {
        return $this->hasOne(SupportPlanMedicationManagement::class);
    }


    public function mobility_transfer()
    {
        return $this->hasOne(SupportPlanMobilityTransfer::class);
    }

    public function fallsRisk()
{
    return $this->hasOne(SupportPlanFallsRisk::class);
}


public function cognition()
{
    return $this->hasOne(\App\Models\SupportPlanCognition::class);
}
public function behaviourSupport()
{
    return $this->hasOne(SupportPlanBehaviourSupport::class);
}

public function personalCare()
{
    return $this->hasOne(SupportPlanPersonalCare::class);
}
public function continence()
{
    return $this->hasOne(SupportPlanContinence::class);
}
public function vision()
{
    return $this->hasOne(SupportPlanVision::class);
}

public function hearing()
{
    return $this->hasOne(SupportPlanHearing::class);
}

public function skinCondition()
{
    return $this->hasOne(SupportPlanSkinCondition::class);
}
public function dietary()
{
    return $this->hasOne(SupportPlanDietary::class);
}

}

