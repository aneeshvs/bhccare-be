<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanTelecommunicationOutage extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_telecommunication_outages';

    protected $fillable = [
        'support_plan_id',
        'independent_leave_home',
        'independent_leave_home_details',
        'has_support_checkin',
        'has_support_checkin_details',
        'welfare_check_required',
        'welfare_check_required_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class, 'support_plan_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('support_plan_telecommunication_outage')
            ->logFillable()
            ->logOnlyDirty();
    }
}
