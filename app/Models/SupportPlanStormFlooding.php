<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanStormFlooding extends DefaultDBModel
{
    protected $table = 'support_plan_storm_floodings';

    protected $fillable = [
        'support_plan_id',
        'home_preparation_support',
        'home_preparation_details',
        'multiple_exit_points',
        'multiple_exit_points_details',
        'identify_flood_risk',
        'identify_flood_risk_details',
        'can_evacuate_independently',
        'evacuate_independently_details',
        'support_from_family_or_neighbour',
        'support_from_family_or_neighbour_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class, 'support_plan_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('support_plan_storm_flooding')
            ->logFillable()
            ->logOnlyDirty();
    }
}
