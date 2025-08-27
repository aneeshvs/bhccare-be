<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanPowerOutage extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_power_outages';

    protected $fillable = [
        'support_plan_id',
        'has_medical_equipment',
        'has_backup_power',
        'backup_power_details',
        'registered_life_support',
        'life_support_hours_supply',
        'life_support_provider',
        'power_independent_leave_home',
        'power_independent_leave_home_details',
        'power_has_support_checkin',
        'power_has_support_checkin_details',
        'power_welfare_check_required',
        'power_welfare_check_required_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class, 'support_plan_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('support_plan_power_outage')
            ->logFillable()
            ->logOnlyDirty();
    }
}
