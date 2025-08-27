<?php

namespace App\Models;

use App\Models\Classes\DefaultDbModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanEmergencyReadiness extends DefaultDbModel
{
    use LogsActivity;

    protected $table = 'support_plan_emergency_readiness';

    protected $fillable = [
        'support_plan_id',
        'at_risk_of_abuse',
        'abuse_details',
        'opan_referral_required',
        'opan_referral_details',
        'risk_of_declining_services',
        'declining_services_details',
        'neglect_indicators',
        'neglect_indicators_details',
        'emergency_accessible',
        'emergency_accessible_details',
        'emergency_support_available',
        'emergency_support_details',
        'vpr_required',
        'vpr_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class, 'support_plan_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('support_plan_emergency_readiness')
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
