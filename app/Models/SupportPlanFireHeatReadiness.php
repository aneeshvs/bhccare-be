<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanFireHeatReadiness extends DefaultDBModel
{
    protected $table = 'support_plan_fire_heat_readiness';

    protected $fillable = [
        'support_plan_id',
        'home_preparation_support',
        'home_preparation_details',
        'hydration_access',
        'hydration_details',
        'home_cooling',
        'home_cooling_details',
        'multiple_exit_points',
        'exit_points_details',
        'identify_fire_risk',
        'fire_risk_details',
        'can_evacuate_independently',
        'evacuate_independently_details',
        'support_from_family_or_neighbour',
        'support_from_family_or_neighbour_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class, 'support_plan_id');
    }

    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
}
