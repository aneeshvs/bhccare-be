<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class IndividualRiskAssessmentCognition extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'assessment_cognitions';

    protected $fillable = [
        'individual_risk_assessment_id',
        'oriented_in_time_place',
        'oriented_hazards',
        'oriented_management_plan',
        'accepts_direction',
        'direction_hazards',
        'direction_management_plan',
        'short_term_memory_issues',
        'memory_hazards',
        'memory_management_plan',
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
            ->useLogName('individual_risk_assessment_cognition');
    }
}
