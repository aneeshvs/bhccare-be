<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanHomeMaintenance extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_home_maintenances';

    protected $fillable = [
        'support_plan_id',
        'needs_domestic_assistance',
        'domestic_assistance_type',
        'domestic_assistance_details',
        'needs_help_with_cleaning_products',
        'cleaning_products_details',
        'needs_garden_support',
        'garden_support_details',
        'trouble_navigating_at_night',
        'navigating_at_night_details',
        'home_maintenance_worries',
        'home_maintenance_worries_details',
        'last_home_safety_assessment',
        'home_safety_focus_areas',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_plan_home_maintenance');
    }
}
