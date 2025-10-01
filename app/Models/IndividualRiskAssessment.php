<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class IndividualRiskAssessment extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'individual_risk_assessments';

    protected $fillable = [
        'user_id',
        'staff_id',
        'client_type',
        'client_name',
        'site_address',
        'assessment_date',
        'planned_review_date',
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

    public function details()
{
    return $this->hasOne(IndividualRiskAssessmentDetail::class, 'individual_risk_assessment_id');
}

public function communications()
{
    return $this->hasOne(IndividualRiskAssessmentCommunication::class, 'individual_risk_assessment_id');
}

public function cognitions()
{
    return $this->hasOne(IndividualRiskAssessmentCognition::class, 'individual_risk_assessment_id');
}
public function mobilities()
{
    return $this->hasOne(IndividualRiskAssessmentMobility::class, 'individual_risk_assessment_id');
}

public function personalCareSupport()
{
    return $this->hasOne(IndividualRiskAssessmentPersonalCareSupport::class, 'individual_risk_assessment_id');
}

public function manualHandlings()
{
    return $this->hasMany(PlanManualHandling::class, 'individual_risk_assessment_id');
}



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('individual_risk_assessment');
    }
}
