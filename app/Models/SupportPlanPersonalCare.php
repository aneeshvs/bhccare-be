<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanPersonalCare extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_personal_cares';

    protected $fillable = [
        'support_plan_id',
        'support_daily_personal_care',
        'daily_personal_care_details',
        'support_showering',
        'showering_type',
        'showering_details',
        'personal_care_routine',
        'support_dressing',
        'dressing_details',
        'dressing_routine',
        'equipment_in_bathroom',
        'equipment_details',
        'support_shaving',
        'shaving_details',
        'support_haircuts',
        'haircuts_details',
        'task_at_home',
        'wears_dentures',
        'dentures_details',
        'support_teeth_brushing',
        'teeth_brushing_details',
        'ot_bathroom_assessment',
        'ot_assessment_type',
        'ot_assessment_details',
        'referral_ot_required',
        'plancare_referral_ot_details',
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
            ->useLogName('support_plan_personal_care');
    }
}
