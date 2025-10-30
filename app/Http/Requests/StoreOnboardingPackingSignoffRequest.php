<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOnboardingPackingSignoffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return array_merge(
            $this->onboardingrules(),
            $this->discussrules(),
            $this->declarationrules(),



        );
    }

    private function onboardingrules(): array
    {
        return [
            // 🔗 Relations & identifiers
            'user_id' => 'nullable|integer',
            'client_type' => 'required|integer',


            // ✅ Checklist booleans & dates
            'service_agreement_provided' => 'nullable|boolean',
            'service_agreement_date' => 'nullable|date',

            'participant_handbook_provided' => 'nullable|boolean',
            'participant_handbook_date' => 'nullable|date',

            'support_care_plan_offered' => 'nullable|boolean',
            'support_care_plan_date' => 'nullable|date',

            'consent_form_signed' => 'nullable|boolean',
            'consent_form_date' => 'nullable|date',

            'feedback_form_provided' => 'nullable|boolean',
            'feedback_form_date' => 'nullable|date',

            'home_safety_check_conducted' => 'nullable|boolean',
            'home_safety_check_date' => 'nullable|date',

            'medication_consent_form' => 'nullable|boolean',
            'medication_consent_date' => 'nullable|date',

            'onboarding_form_completed' => 'nullable|boolean',
            'onboarding_form_date' => 'nullable|date',

            'risk_assessment_completed' => 'nullable|boolean',
            'risk_assessment_date' => 'nullable|date',

            'behaviour_support_plan_obtained' => 'nullable|boolean',
            'behaviour_support_plan_date' => 'nullable|date',

            'high_intensity_support_plan_obtained' => 'nullable|boolean',
            'high_intensity_support_plan_date' => 'nullable|date',

            'mealtime_plan_obtained' => 'nullable|boolean',
            'mealtime_plan_date' => 'nullable|date',

            'sil_occupancy_agreement_provided' => 'nullable|boolean',
            'sil_occupancy_agreement_date' => 'nullable|date',

            'external_provider_agreement_completed' => 'nullable|boolean',
            'external_provider_agreement_date' => 'nullable|date',

            'sda_residency_agreement_provided' => 'nullable|boolean',
            'sda_residency_agreement_date' => 'nullable|date',

            'sda_welcome_pack_provided' => 'nullable|boolean',
            'sda_welcome_pack_date' => 'nullable|date',

            'sda_residency_statement_provided' => 'nullable|boolean',
            'sda_residency_statement_date' => 'nullable|date',

            // ✅ Meta fields
            'form_status' => 'nullable|string|in:in_progress,completed,draft',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
        ];
    }

    private function discussrules(): array
    {
        return [

            'clarify_services_provided' => 'nullable|boolean',
            'verbal_information_intake_process' => 'nullable|boolean',
            'cost_of_services' => 'nullable|boolean',
            'participant_rights_handbook' => 'nullable|boolean',
        ];
    }

    private function declarationrules(): array
    {
        return [

            'participant_name' => 'nullable|string|max:255',
            'relationship_to_participant' => 'nullable|string|max:255',
            'participant_signature' => 'nullable|string',
            'signed_date' => 'nullable|date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ], 422));
    }


}
