<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class IndividualRiskAssessmentViolenceRisk extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'assessment_violence_risks';

    protected $fillable = [
        'individual_risk_assessment_id',

        'physical_aggression', 'physical_hazards', 'physical_management_plan', 'physical_bsp_plan',
        'verbal_aggression', 'verbal_hazards', 'verbal_management_plan', 'verbal_bsp_plan', 'verbal_aggression_notes',
        'client_aggression', 'client_hazards', 'client_management_plan', 'client_bsp_plan',
        'self_harm', 'self_harm_hazards', 'self_harm_management_plan', 'self_harm_bsp_plan',
        'drug_alcohol_use', 'drug_alcohol_hazards', 'drug_alcohol_management_plan', 'drug_alcohol_bsp_plan',
        'sexual_abuse_history', 'sexual_abuse_hazards', 'sexual_abuse_management_plan', 'sexual_abuse_bsp_plan',
        'emotional_manipulation', 'emotional_hazards', 'emotional_management_plan', 'emotional_bsp_plan',
        'other_known_risks', 'other_risks_hazards', 'other_risks_management_plan', 'other_risks_bsp_plan',
        'finance_management', 'finance_hazards', 'finance_management_plan', 'finance_bsp_plan', 'finance_management_notes',
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
            ->useLogName('individual_risk_assessment_violence_risk');
    }
}
