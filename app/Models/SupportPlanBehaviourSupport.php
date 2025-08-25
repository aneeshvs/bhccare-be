<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanBehaviourSupport extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_behaviour_supports';

    protected $fillable = [
        'support_plan_id',
        'feeling_agitation',
        'feeling_agitation_details',
        'delusions_hallucinations',
        'delusions_hallucinations_details',
        'personality_changes',
        'personality_changes_details',
        'wandering_purpose',
        'wandering_purpose_details',
        'absconding_concerns',
        'absconding_concerns_details',
        'verbal_threats',
        'verbal_threats_details',
        'physical_assault',
        'physical_assault_details',
        'restrictive_interventions',
        'restrictive_interventions_details',
        'restrictive_physical',
        'restrictive_approved_by_practitioner',
        'restrictive_practitioner_details',
        'current_strategies',
        'referral_positive_behaviour_practitioner',
        'referral_positive_behaviour_practitioner_details',
        'behaviour_support_plan_required',
        'behaviour_support_plan_expiry',
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
            ->useLogName('support_plan_behaviour_support');
    }
}
