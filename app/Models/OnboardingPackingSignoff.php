<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OnboardingPackingSignoff extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'staff_id',
        'user_id',
        'client_type',

        'service_agreement_provided',
        'service_agreement_date',
        'participant_handbook_provided',
        'participant_handbook_date',
        'support_care_plan_offered',
        'support_care_plan_date',
        'consent_form_signed',
        'consent_form_date',
        'feedback_form_provided',
        'feedback_form_date',
        'home_safety_check_conducted',
        'home_safety_check_date',
        'medication_consent_form',
        'medication_consent_date',
        'onboarding_form_completed',
        'onboarding_form_date',
        'risk_assessment_completed',
        'risk_assessment_date',
        'behaviour_support_plan_obtained',
        'behaviour_support_plan_date',
        'high_intensity_support_plan_obtained',
        'high_intensity_support_plan_date',
        'mealtime_plan_obtained',
        'mealtime_plan_date',
        'sil_occupancy_agreement_provided',
        'sil_occupancy_agreement_date',
        'external_provider_agreement_completed',
        'external_provider_agreement_date',
        'sda_residency_agreement_provided',
        'sda_residency_agreement_date',
        'sda_welcome_pack_provided',
        'sda_welcome_pack_date',
        'sda_residency_statement_provided',
        'sda_residency_statement_date',


        'form_status',
        'completion_percentage',
    ];


    protected $casts = [
        'service_agreement_provided' => 'integer',
        'participant_handbook_provided' => 'integer',
        'support_care_plan_offered' => 'integer',
        'consent_form_signed' => 'integer',
        'feedback_form_provided' => 'integer',
        'home_safety_check_conducted' => 'integer',
        'medication_consent_form' => 'integer',
        'onboarding_form_completed' => 'integer',
        'risk_assessment_completed' => 'integer',
        'behaviour_support_plan_obtained' => 'integer',
        'high_intensity_support_plan_obtained' => 'integer',
        'mealtime_plan_obtained' => 'integer',
        'sil_occupancy_agreement_provided' => 'integer',
        'external_provider_agreement_completed' => 'integer',
        'sda_residency_agreement_provided' => 'integer',
        'sda_welcome_pack_provided' => 'integer',
        'sda_residency_statement_provided' => 'integer',
    ];


    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('onboarding_packing_signoff');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Onboarding Packing Sign Off record has been {$eventName}";
    }
}
