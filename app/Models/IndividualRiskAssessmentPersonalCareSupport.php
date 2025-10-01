<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class IndividualRiskAssessmentPersonalCareSupport extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'assessment_personal_care';

    protected $fillable = [
        'individual_risk_assessment_id',
        'showering', 'showering_hazards', 'showering_management_plan',
        'meal', 'meal_hazards', 'meal_management_plan',
        'toileting', 'toileting_hazards', 'toileting_management_plan',
        'grooming', 'grooming_hazards', 'grooming_management_plan',
        'repositioning_bed', 'repositioning_bed_hazards', 'repositioning_bed_management_plan',
        'repositioning_chair', 'repositioning_chair_hazards', 'repositioning_chair_management_plan',
        'mouthcare', 'mouthcare_hazards', 'mouthcare_management_plan',
        'skin_care', 'skin_care_hazards', 'skin_care_management_plan',
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
            ->useLogName('individual_risk_assessment_personal_care');
    }
}
