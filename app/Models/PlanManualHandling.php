<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PlanManualHandling extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'plan_manual_handlings';

    protected $fillable = [
        'individual_risk_assessment_id',
        'goal_key',
        'training_provided',
        'training_hazards',
        'training_management_plan',
        'tasks_safe',
        'tasks_hazards',
        'tasks_management_plan',
    ];

    public function supportCarePlan()
    {
        return $this->belongsTo(IndividualRiskAssessment::class, 'individual_risk_assessment_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('plan_manual_handlings');
    }
}
