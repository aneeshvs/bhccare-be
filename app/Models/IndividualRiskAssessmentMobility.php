<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class IndividualRiskAssessmentMobility extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'assessment_mobilities';

    protected $fillable = [
        'individual_risk_assessment_id',

        'walk_unaided',
        'accessibility_required',
        'walk_hazards',
        'walk_management_plan',

        'manages_stairs',
        'stairs_hazards',
        'stairs_management_plan',

        'uses_walking_aid',
        'walking_aid_hazards',
        'walking_aid_management_plan',

        'uses_wheelchair',
        'wheelchair_hazards',
        'wheelchair_management_plan',

        'bed_transfer',
        'bed_transfer_hazards',
        'bed_transfer_management_plan',

        'vehicle_transfer',
        'vehicle_transfer_hazards',
        'vehicle_transfer_management_plan',

        'toilet_transfer',
        'toilet_transfer_hazards',
        'toilet_transfer_management_plan',
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
            ->useLogName('individual_risk_assessment_mobility');
    }
}
