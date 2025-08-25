<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanFallsRisk extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_falls_risks';

    protected $fillable = [
        'support_plan_id',
        'recent_falls',
        'recent_falls_details',
        'strategies_to_reduce_risk',
        'strategies_details',
        'has_safety_pendant',
        'safety_pendant_details',
        'worried_about_falling',
        'worried_details',
        'referral_falls_clinic',
        'referral_falls_clinic_details',
        'referral_ot_required',
        'referral_ot_details',
        'referral_physio_required',
        'referral_physio_details',
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
            ->useLogName('support_plan_falls_risk');
    }
}
