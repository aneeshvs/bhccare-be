<?php

namespace App\Models;

use App\Models\Classes\DefaultDbModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanInformalSupport extends DefaultDbModel
{
    use LogsActivity;

    protected $table = 'support_plan_informal_supports';

    protected $fillable = [
        'support_plan_id',
        'is_primary_caregiver',
        'primary_caregiver_details',
        'receiving_help',
        'receiving_help_details',
        'carer_lives_with_you',
        'carer_lives_with_you_details',
        'carer_receives_pension',
        'carer_pension_details',
        'factors_affecting_care',
        'factors_affecting_care_details',
        'caregiver_strain_index_required',
        'carer_gateway_referral',
        'carer_gateway_referral_details',
        'primary_caregiver_receives_allowance',
    ];

    /**
     * Relationship: belongs to SupportPlan
     */
    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class, 'support_plan_id');
    }

    /**
     * Spatie Activitylog options
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('support_plan_informal_support')
            ->logFillable() // log all $fillable attributes
            ->logOnlyDirty() // log only changed fields
            ->dontSubmitEmptyLogs();
    }
}
