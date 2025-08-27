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
        'storm_home_preparation_support',
        'storm_home_preparation_details',
        'storm_multiple_exit_points',
        'storm_multiple_exit_points_details',
        'identify_flood_risk',
        'identify_flood_risk_details',
        'storm_can_evacuate_independently',
        'storm_evacuate_independently_details',
        'storm_support_from_family_or_neighbour',
        'storm_support_from_family_or_neighbour_details',
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
