<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class IndividualRiskAssessmentCommunication extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'assessment_communications';

    protected $fillable = [
        'individual_risk_assessment_id',
        'hearing_impairment',
        'hearing_hazards',
        'hearing_management_plan',
        'speech_impairment',
        'speech_hazards',
        'speech_management_plan',
    ];

    public function riskAssessment()
    {
        return $this->belongsTo(IndividualRiskAssessment::class, 'individual_risk_assessment_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('individual_risk_assessment_communication');
    }
}
