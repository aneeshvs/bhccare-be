<?php

namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class IndividualRiskAssessmentDetail extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'assessment_details';

    protected $fillable = [
        'individual_risk_assessment_id',
        'vulnerability',
        'review_frequency',
        'dependent_on_homecare',

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
            ->useLogName('individual_risk_assessment_detail');
    }
}
