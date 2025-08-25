<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanCognition extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_cognitions';

    protected $fillable = [
        'support_plan_id',
        'cognitive_concerns',
        'cognitive_concerns_details',
        'diagnosis_dementia',
        'diagnosis_dementia_details',
        'capable_of_decisions',
        'capable_of_decisions_details',
        'has_power_of_attorney',
        'power_of_attorney_details',
        'becomes_confused',
        'becomes_confused_details',
        'experienced_delirium',
        'experienced_delirium_details',
        'anxious_or_worry',
        'anxious_or_worry_details',
        'short_term_memory_loss',
        'short_term_memory_loss_details',
        'long_term_memory_loss',
        'long_term_memory_loss_details',
        'atsi_kica_cog_required',
        'atsi_kica_cog_file',
        'atsi_kica_carer_required',
        'atsi_kica_carer_file',
        'gpcog_required',
        'gpcog_file',
        'health_literacy_support',
        'health_literacy_support_details',
        'gds_required',
        'gds_file',
        'referral_geriatrician',
        'referral_geriatrician_details',
        'referral_psychologist',
        'referral_psychologist_details',
        'referral_psychiatrist',
        'referral_psychiatrist_details',
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
            ->useLogName('support_plan_cognition');
    }
}
