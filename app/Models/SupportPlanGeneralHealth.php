<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanGeneralHealth extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_general_health';

    protected $fillable = [
        'support_plan_id',
        'gp_visit_frequency',
        'admitted_hospital_last12months',
        'admitted_hospital_details',
        'preferred_hospital',
        'preferred_hospital_details',
        'diagnosis_medication_conditions',
        'previous_surgeries',
        'has_allergies',
        'allergy_details',
        'health_impact_scale',
        'painful_day_to_day',
        'painful_day_to_day_details',
        'weight_loss_last3months',
        'weight_loss_details',
        'nutritional_concerns',
        'nutritional_concerns_details',
        'current_weight',
        'annual_vaccinations',
        'annual_vaccination_details',
        'last_influenza_vaccine',
        'last_covid19_vaccine',
        'last_pneumonia_vaccine',
        'sleep_difficulties',
        'sleep_difficulties_details',
        'sleep_routine',
        'sleep_routine_worries',
        'sleep_routine_worries_details',
        'alcohol_smoke_drug_use',
        'alcohol_smoke_drug_details',
        'alcohol_smoke_drug_worries',
        'alcohol_smoke_drug_worries_details',
        'referral_required',
        'referral_required_details',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logAll()
            ->useLogName('support_plan_general_health');
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
