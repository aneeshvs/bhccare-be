<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupportPlanRequest extends FormRequest
{

        protected function prepareForValidation()
        {
            if (is_string($this->support_plan_services)) {
                $this->merge([
                    'support_plan_services' => json_decode($this->support_plan_services, true),
                ]);
            }
            if (is_string($this->support_plan_my_goals)) {
            $this->merge([
                'support_plan_my_goals' => json_decode($this->support_plan_my_goals, true),
            ]);
        }

        }


    public function rules()
    {
        return array_merge(
            $this->SupportRules(),
            $this->SupportApprovalRules(),
            $this->RepresentaiveRules(),
            $this->SupportCarePartnerRules(),
            $this->Keeptouchrules(),
            $this->nonresponsiverules(),
            $this->participantrules(),
            $this->contactrules(),
            $this->secondarycontactrules(),
            $this->Fundingrules(),
            $this->servicerules(),
            $this->employeerules(),
            $this->mygoalrules(),
            $this->livingarrangementrules(),
            $this->diversityrules(),
            $this->healthrules(),
            $this->medicationsrules(),
            $this->mobilitytransferules(),
            $this->fallriskrules(),
            $this->cognitiverules(),
            $this->behaiviourules(),
            $this->plancarerules(),
            $this->continencerules(),
            $this->visionrules(),
            $this->hearingrules(),






        );
    }



    private function SupportRules(): array
    {
        return [
            'user_id' => 'required|integer',
            'client_type' => 'required|in:1,2',
            'effective_date' => 'nullable|date',
            'review_date' => 'nullable|date|after_or_equal:effective_date',
            'confirmation_date' => 'nullable|date',
            'developed_by' => 'nullable|string',
            'invited_but_not_participated' => 'nullable|string',
        ];

    }
    private function SupportApprovalRules(): array
    {
        return [

            'participant_name' => 'nullable|string|max:255',
            'date_of_approval' => 'nullable|date',
            'signature' => 'nullable|string', // Or file if needed
        ];
    }

    public function RepresentaiveRules():array
    {
        return [

            'support_representative_name' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'date_of_approval' => 'nullable|date',
        ];
    }
    private function SupportCarePartnerRules(): array
{
    return [
        'care_partner_name' => 'nullable|string|max:255',
        'care_partner_role' => 'nullable|string|max:255',
        'care_partner_contact_phone' => 'nullable|string|max:20',
        'care_partner_email' => 'nullable|email|max:255',
    ];
}
    public function Keeptouchrules(): array
    {
        return [

            'need_help_to_communicate' => 'nullable|boolean',
            'type_of_difficulty' => 'nullable|string|max:255',
            'contact_first_instance' => 'nullable|boolean',
            'details' => 'nullable|string',
            'language_spoken' => 'nullable|string|max:255',
            'use_nrs' => 'nullable|boolean',
            'require_interpreter' => 'nullable|boolean',
            'written' => 'nullable|string|max:255',
            'verbal' => 'nullable|string|max:255',
            'schedule_change_notification' => 'nullable|string|max:255',
            'interpreter_arrangement' => 'nullable|string|max:255',
            'financial_statement_method' => 'nullable|string|max:255',
            'feedback_survey_method' => 'nullable|string|max:255',
            'marketing_material_method' => 'nullable|string|max:255',
            'preferred_communication_method' => 'nullable|string|max:255',
            'join_cab' => 'nullable|boolean',
        ];
    }

    public function nonresponsiverules(): array
    {
        return [


            'telephone_home_or_mobile' => 'nullable|boolean',
            'telephone_details' => 'nullable|string',


            'contact_emergency_contact' => 'nullable|boolean',
            'emergency_contact_details' => 'nullable|string',

            'access_spare_key' => 'nullable|boolean',
            'spare_key_details' => 'nullable|string',

            'contact_other_persons' => 'nullable|boolean',
            'other_persons_details' => 'nullable|string',

            'contact_police_if_no_key' => 'nullable|boolean',
            'police_contact_details' => 'nullable|string',

            'access_key_lock' => 'nullable|boolean',
            'key_lock_code' => 'nullable|string|max:255',
            'key_lock_details' => 'nullable|string',
        ];
    }

    public function participantrules(): array
    {
        return [
            'first_name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'preferred_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'country_of_birth' => 'nullable|string|max:255',
            'identify_as_aboriginal_or_torres_strait' => 'boolean',
            'gender' => 'nullable|in:Male,Female,Other',
        ];
    }
    public function contactrules(): array
    {
        return [

            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'is_rural_area' => 'nullable|boolean',
            'mailing_address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ];
    }

    public function secondarycontactrules(): array
    {
        return [

            'secondary_role' => 'nullable|string|max:255',
            'secondary_phone' => 'nullable|string|max:20',
            'secondary_email' => 'nullable|email|max:255',
            'secondary_address' => 'nullable|string|max:500',
            'secondary_best_time_to_contact' => 'nullable|string|max:255',

            'secondary_is_mac_registered' => 'boolean',
            'secondary_list_documents' => 'nullable|string',
            'secondary_legal_documentation_stored' => 'boolean',
            'secondary_date_legal_orders_end' => 'nullable|date',

            'secondary_participants_agreed_contact' => 'boolean',
            'secondary_participants_agreed_contact_date' => 'nullable|date',

            'secondary_decision_making_approval_for' => 'nullable|string',
        ];
    }

    public function Fundingrules(): array
    {
        return [


            'aged_care_id'            => 'nullable|string|max:255',
            'pension_status'          => 'nullable|string|max:255',
            'pension_card_details'    => 'nullable|string|max:255',
            'card_number'             => 'nullable|string|max:255',
            'card_expiry'             => 'nullable|date',
            'approved_funding_level'  => 'nullable|string|max:255',
            'awaiting_package_upgrade'=> 'nullable|boolean',
            'upgrade_details'         => 'nullable|string',

            'has_chsp_referral_codes' => 'nullable|boolean',
            'chsp_referral_details'   => 'nullable|string',

            'war_veteran_or_widow'    => 'nullable|boolean',
            'dva_number'              => 'nullable|string|max:255',
            'medicare_number'         => 'nullable|string|max:255',
            'private_health_insurance'=> 'nullable|string|max:255',
            'hcp_funding_level'       => 'nullable|string|max:255',
            'has_companion_card'      => 'nullable|boolean',


        ];
    }

    public function servicerules(): array
    {
        return [


            'support_plan_services' => 'nullable|array',
            'support_plan_services.*.name' => 'nullable|string|max:255',
            'support_plan_services.*.service_provided' => 'nullable|string|max:255',
            'support_plan_services.*.funded_by' => 'nullable|string|max:255',
            'support_plan_services.*.duration_frequency' => 'nullable|string|max:255',
            'support_plan_services.*.support_to_implement_by_us' => 'nullable|boolean',


        ];
    }

    public function employeerules(): array
    {
        return [

            'cultural_considerations' => 'nullable|string',
            'specific_training_required' => 'nullable|string',
            'common_interests' => 'nullable|string',

        ];
    }

    public function mygoalrules(): array
    {
        return [


            'support_plan_my_goals'   => 'nullable|array',
            'support_plan_my_goals.*.goal' => 'nullable|string|max:255',
            'support_plan_my_goals.*.measure_progress' => 'nullable|string|max:255',
            'support_plan_my_goals.*.success_look_like' => 'nullable|string|max:255',
            'support_plan_my_goals.*.who_will_support' => 'nullable|string|max:255',
            'support_plan_my_goals.*.participant_support' => 'nullable|string|max:255',
            'support_plan_my_goals.*.when_to_meet_goal' => 'nullable|string|max:255',
        ];
    }

    public function livingarrangementrules(): array
    {
        return [

            'reside_in' => 'nullable|string|max:255',
            'reside_with' => 'nullable|string|max:255',
            'home_safety_assessment_date' => 'nullable|date',
            'is_home_suitable' => 'nullable|boolean',
            'home_suitable_details' => 'nullable|string',
            'at_risk_of_homelessness' => 'nullable|boolean',
            'homelessness_details' => 'nullable|string',
        ];
    }

    public function diversityrules(): array
    {
        return [


            'is_lgbti' => 'nullable|boolean',
            'lgbti_details' => 'nullable|string',

            'is_separated_family' => 'nullable|boolean',
            'separated_family_details' => 'nullable|string',

            'has_cultural_events' => 'nullable|boolean',
            'cultural_events_details' => 'nullable|string',

            'has_past_events' => 'nullable|boolean',
            'past_events_details' => 'nullable|string',

            'has_non_disclosure_items' => 'nullable|boolean',
            'non_disclosure_details' => 'nullable|string',
        ];
    }

    public function healthrules(): array
    {
        return [

            'gp_visit_frequency' => 'nullable|string|max:255',

            'admitted_hospital_last12months' => 'nullable|boolean',
            'admitted_hospital_details' => 'nullable|string',

            'preferred_hospital' => 'nullable|boolean',
            'preferred_hospital_details' => 'nullable|string',

            'diagnosis_medication_conditions' => 'nullable|string',
            'previous_surgeries' => 'nullable|string',

            'has_allergies' => 'nullable|boolean',
            'allergy_details' => 'nullable|string',

            'health_impact_scale' => 'nullable|integer|min:1|max:10',

            'painful_day_to_day' => 'nullable|boolean',
            'painful_day_to_day_details' => 'nullable|string',

            'weight_loss_last3months' => 'nullable|boolean',
            'weight_loss_details' => 'nullable|string',

            'nutritional_concerns' => 'nullable|boolean',
            'nutritional_concerns_details' => 'nullable|string',

            'current_weight' => 'nullable|string|max:50',

            'annual_vaccinations' => 'nullable|boolean',
            'annual_vaccination_details' => 'nullable|string',

            'last_influenza_vaccine' => 'nullable|date',
            'last_covid19_vaccine' => 'nullable|date',
            'last_pneumonia_vaccine' => 'nullable|date',

            'sleep_difficulties' => 'nullable|boolean',
            'sleep_difficulties_details' => 'nullable|string',

            'sleep_routine' => 'nullable|string',

            'sleep_routine_worries' => 'nullable|boolean',
            'sleep_routine_worries_details' => 'nullable|string',

            'alcohol_smoke_drug_use' => 'nullable|boolean',
            'alcohol_smoke_drug_details' => 'nullable|string',

            'alcohol_smoke_drug_worries' => 'nullable|boolean',
            'alcohol_smoke_drug_worries_details' => 'nullable|string',

            'referral_required' => 'nullable|boolean',
            'referral_required_details' => 'nullable|string',
        ];
    }

    public function medicationsrules(): array
    {
        return [

            'takes_regular_medications' => 'nullable|boolean',
            'medication_details' => 'nullable|string',
            'medication_form' => 'nullable|string',
            'medication_packaging' => 'nullable|string',
            'medications_locked' => 'nullable|boolean',
            'medications_locked_details' => 'nullable|string',
            'specific_storage_requirements' => 'nullable|string',
            'scheduled_4_or_8_medications' => 'nullable|boolean',
            'scheduled_medications_details' => 'nullable|string',
            'chemical_restraint_medications' => 'nullable|boolean',
            'takes_more_than_prescribed' => 'nullable|boolean',
            'takes_more_than_prescribed_details' => 'nullable|string',
            'at_risk_of_missing_medication' => 'nullable|boolean',
            'missing_medication_details' => 'nullable|string',
            'able_to_explain_purpose' => 'nullable|boolean',
            'last_medication_review_date' => 'nullable|date',
            'medication_collection_delivery_details' => 'nullable|string',
            'needs_support_with_medication' => 'nullable|boolean',
            'support_with_medication_details' => 'nullable|string',
            'medication_management_worries' => 'nullable|boolean',
            'medication_management_worries_details' => 'nullable|string',
            'medication_service_required' => 'nullable|boolean',
            'support_worker_prompt' => 'nullable|boolean',
        ];
    }

    public function mobilitytransferules(): array
    {
        return [

            'can_walk_independently' => 'nullable|boolean',
            'walk_independently_details' => 'nullable|string',
            'needs_transfer_support' => 'nullable|boolean',
            'primary_equipment_used' => 'nullable|string',
            'can_climb_stairs' => 'nullable|boolean',
            'climb_stairs_details' => 'nullable|string',
            'has_stairs_at_home' => 'nullable|boolean',
            'stairs_at_home_details' => 'nullable|string',
            'can_transfer_self' => 'nullable|boolean',
            'can_transfer_in_other_envs' => 'nullable|boolean',
            'uses_bed_pole_or_rails' => 'nullable|boolean',
            'bed_pole_prescribed_by_ot' => 'nullable|boolean',
            'can_access_places_outside_walking_distance' => 'nullable|boolean',
            'access_places_details' => 'nullable|string',
            'safe_to_mobilise_in_yard' => 'nullable|boolean',
            'mobilise_yard_details' => 'nullable|string',
            'community_access' => 'nullable|string',
            'drives' => 'nullable|boolean',
            'medications_or_conditions_risk' => 'nullable|boolean',
            'driving_risk_details' => 'nullable|string',
            'mobility_equipment' => 'nullable|string',
            'equipment_purchase_type' => 'nullable|string',
            'uses_four_wheel_walker' => 'nullable|boolean',
            'four_wheel_walker_details' => 'nullable|string',
            'wheelchair_type' => 'nullable|string',
            'wheelchair_operation' => 'nullable|string',
            'wheelchair_ot_recommended' => 'nullable|boolean',
            'can_charge_wheelchair' => 'nullable|boolean',
            'last_wheelchair_service_date' => 'nullable|date',
            'can_carry_5kg' => 'nullable|boolean',
            'carry_5kg_details' => 'nullable|string',
            'foot_problems' => 'nullable|boolean',
            'foot_problems_details' => 'nullable|string',
            'mobility_worries' => 'nullable|boolean',
            'mobility_worries_details' => 'nullable|string',
            'last_ot_assessment_date' => 'nullable|date',
            'new_ot_referral_required' => 'nullable|boolean',
            'demmi_assessment_required' => 'nullable|boolean',
            'demmi_assessment_result' => 'nullable|string',
        ];
    }

    public function fallriskrules(): array
    {
        return [

            'recent_falls' => ['nullable', 'boolean'],
            'recent_falls_details' => ['nullable', 'string'],

            'strategies_to_reduce_falls' => ['nullable', 'boolean'],
            'strategies_details' => ['nullable', 'string'],

            'safety_pendant' => ['nullable', 'boolean'],
            'safety_pendant_details' => ['nullable', 'string'],

            'worried_about_falling' => ['nullable', 'boolean'],
            'worried_about_falling_details' => ['nullable', 'string'],

            'referral_falls_clinic' => ['nullable', 'boolean'],
            'referral_falls_clinic_details' => ['nullable', 'string'],

            'referral_ot' => ['nullable', 'boolean'],
            'referral_ot_details' => ['nullable', 'string'],

            'referral_physiotherapist' => ['nullable', 'boolean'],
            'referral_physiotherapist_details' => ['nullable', 'string']

        ];
    }

    public function cognitiverules(): array
    {
        return [

            'cognitive_concerns' => 'nullable|boolean',
            'cognitive_concerns_details' => 'nullable|string',

            'diagnosis_dementia' => 'nullable|boolean',
            'diagnosis_dementia_details' => 'nullable|string',

            'capable_of_decisions' => 'nullable|boolean',
            'capable_of_decisions_details' => 'nullable|string',

            'has_power_of_attorney' => 'nullable|boolean',
            'power_of_attorney_details' => 'nullable|string',

            'becomes_confused' => 'nullable|boolean',
            'becomes_confused_details' => 'nullable|string',

            'experienced_delirium' => 'nullable|boolean',
            'experienced_delirium_details' => 'nullable|string',

            'anxious_or_worry' => 'nullable|boolean',
            'anxious_or_worry_details' => 'nullable|string',

            'short_term_memory_loss' => 'nullable|boolean',
            'short_term_memory_loss_details' => 'nullable|string',

            'long_term_memory_loss' => 'nullable|boolean',
            'long_term_memory_loss_details' => 'nullable|string',

            'atsi_kica_cog_required' => 'nullable|boolean',
            'atsi_kica_cog_file' => 'nullable|string',

            'atsi_kica_carer_required' => 'nullable|boolean',
            'atsi_kica_carer_file' => 'nullable|string',

            'gpcog_required' => 'nullable|boolean',
            'gpcog_file' => 'nullable|string',

            'health_literacy_support' => 'nullable|boolean',
            'health_literacy_support_details' => 'nullable|string',

            'gds_required' => 'nullable|boolean',
            'gds_file' => 'nullable|string',

            'referral_geriatrician' => 'nullable|boolean',
            'referral_geriatrician_details' => 'nullable|string',

            'referral_psychologist' => 'nullable|boolean',
            'referral_psychologist_details' => 'nullable|string',

            'referral_psychiatrist' => 'nullable|boolean',
            'referral_psychiatrist_details' => 'nullable|string',



        ];
    }

    public function behaiviourules(): array
    {
        return [


            'feeling_agitation'              => 'nullable|boolean',
            'feeling_agitation_details'      => 'nullable|string',

            'delusions_hallucinations'       => 'nullable|boolean',
            'delusions_hallucinations_details' => 'nullable|string',

            'personality_changes'            => 'nullable|boolean',
            'personality_changes_details'    => 'nullable|string',

            'wandering'                      => 'nullable|boolean',
            'wandering_details'              => 'nullable|string',

            'absconding'                     => 'nullable|boolean',
            'absconding_details'             => 'nullable|string',

            'verbal_threats'                 => 'nullable|boolean',
            'verbal_threats_details'         => 'nullable|string',

            'physical_assault'               => 'nullable|boolean',
            'physical_assault_details'       => 'nullable|string',

            'restrictive_interventions'      => 'nullable|boolean',
            'restrictive_interventions_details' => 'nullable|string',

            'interventions_approved'         => 'nullable|boolean',
            'interventions_approved_details' => 'nullable|string',

            'current_strategies'             => 'nullable|string',

            'referral_pbsp'                  => 'nullable|boolean',
            'referral_pbsp_details'          => 'nullable|string',

            'bsp_required'                   => 'nullable|boolean',
            'bsp_expiry_date'                => 'nullable|date',
        ];
    }


    public function plancarerules(): array
    {
        return [

            'support_daily_personal_care' => 'nullable|boolean',
            'daily_personal_care_details' => 'nullable|string',

            'support_showering' => 'nullable|boolean',
            'showering_type' => 'nullable|string', // e.g., Supervision, Assistance
            'showering_details' => 'nullable|string',

            'personal_care_routine' => 'nullable|string',

            'support_dressing' => 'nullable|boolean',
            'dressing_details' => 'nullable|string',
            'dressing_routine' => 'nullable|string',

            'equipment_in_bathroom' => 'nullable|boolean',
            'equipment_details' => 'nullable|string',

            'support_shaving' => 'nullable|boolean',
            'shaving_details' => 'nullable|string',

            'support_haircuts' => 'nullable|boolean',
            'haircuts_details' => 'nullable|string',

            'task_at_home' => 'nullable|boolean',

            'wears_dentures' => 'nullable|boolean',
            'dentures_details' => 'nullable|string',

            'support_teeth_brushing' => 'nullable|boolean',
            'teeth_brushing_details' => 'nullable|string',

            'ot_bathroom_assessment' => 'nullable|boolean',
            'ot_assessment_type' => 'nullable|string', // e.g., Supervision
            'ot_assessment_details' => 'nullable|string',

            'referral_ot_required' => 'nullable|boolean',
            'referral_ot_details' => 'nullable|string',
        ];
    }

    public function continencerules(): array
    {
        return [

            'identified_needs' => 'nullable|boolean',
            'identified_needs_details' => 'nullable|string',

            'identify_toilet_needs' => 'nullable|boolean',
            'identify_toilet_needs_details' => 'nullable|string',

            'require_prompting' => 'nullable|boolean',
            'require_prompting_details' => 'nullable|string',

            'wears_continence_aids' => 'nullable|boolean',
            'continence_aids_details' => 'nullable|string',

            'ruis_required' => 'nullable|boolean',
            'ruis_details' => 'nullable|string',

            'rfis_required' => 'nullable|boolean',
            'rfis_details' => 'nullable|string',

            'funding_for_products' => 'nullable|boolean',
            'funding_for_products_details' => 'nullable|string',

            'nurse_assessment' => 'nullable|boolean',
            'nurse_assessment_details' => 'nullable|string',

            'worry_about_continence' => 'nullable|boolean',
            'worry_about_continence_details' => 'nullable|string',
        ];
    }

    public function visionrules(): array
    {
        return [

            'wears_glasses_or_contacts'   => 'nullable|boolean',
            'glasses_or_contacts_type'    => 'nullable|string|max:255',
            'when_worn'                   => 'nullable|string|max:255',
            'last_optometrist_appointment'=> 'nullable|date',
            'vision_worry'                => 'nullable|boolean',
            'vision_worry_details'        => 'nullable|string',
        ];
    }

    public function hearingrules(): array
    {
        return [

            'wears_hearing_devices' => 'nullable|boolean',
            'hearing_devices_details' => 'nullable|string',
            'when_worn' => 'nullable|string|max:255',
            'last_audiologist_appointment' => 'nullable|date',

            'hearing_worry' => 'nullable|boolean',
            'hearing_worry_details' => 'nullable|string',
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['success' => false, 'status' => 400, 'message' => 'Invalid Format', 'data' => $errors, 'alert' => true], 200)
        );
    }
}
