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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('individual_risk_assessment');
    }
}
