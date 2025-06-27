<?php //store full form request validation
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFullFormRequest extends FormRequest
{
    public function authorize()
    {
        return true; // or implement your auth logic
    }

    public function rules()
    {
        return array_merge(
            $this->accommodationRules(),
            $this->clientRules(),
            $this->referralRules(),
            $this->previousserviceRules(),
            $this->serviceRules(),
            $this->ndisRules(),
            $this->medicalRules(),
            $this->housingRules(),
            $this->rosterRules(),
            $this->goalRules(),
            $this->independentLivingRules(),
            $this->finalDeclarationRules(),


        );
    }

    private function accommodationRules(): array
    {
        return [
            'type_of_accommodation' => 'nullable|string|max:255',
            'requested_support'     => 'nullable|string',
            'worker_preference'     => 'nullable|in:Male,Female,No Preference',
            'date_of_referral'      => 'nullable|date',
        ];
    }

    private function clientRules(): array
    {
        return [
            'full_name'             => 'required|string|max:255',
            'date_of_birth'         => 'required|date',
            'gender'                => 'required|in:Male,Female,Other',
            'residential_address'   => 'required|string',
            'contact_type'          => 'required|in:Home_phone,Work_phone',
            'mobile'                => 'required|string|max:15',
            'email'                 => 'nullable|email|max:255',
            'atsi_status'           => 'required|in:Aboriginal,Torres Strait Islander,Neither,Both',
            'cultural_background'   => 'nullable|string',
            'language_spoken'       => 'nullable|string',
            'interpreter_required'  => 'boolean',

            'guardian_name'             => 'nullable|string|max:255',
            'is_public_guardian'        => 'nullable|string|max:255',
            'guardian_relationship'     => 'nullable|string|max:100',
            'guardian_mobile'           => 'nullable|string|max:15',
            'guardian_email'            => 'nullable|email|max:255',
            'guardian_address'          => 'nullable|string',
            'guardian_contact_method'   => 'nullable|string|max:100',
        ];
    }

    private function referralRules(): array
    {
        return [
            'agency'          => 'nullable|string|max:255',
            'contact_name'    => 'nullable|string|max:255',
            'job_title'       => 'nullable|string|max:255',
            'work_contact'    => 'nullable|string|max:20',
            'mobile'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'has_consent'     => 'nullable|boolean',
        ];
    }
    private function previousserviceRules(): array
    {
       return[

            'previous_service_providers.*.provider' => 'nullable|string|max:255',
            'previous_service_providers.*.contact_details' => 'nullable|string|max:255',
            'previous_service_providers.*.length_of_support' => 'nullable|string|max:255',
            'previous_service_providers.*.reason_for_leaving' => 'nullable|string|max:1000',

       ];
    }
    public function serviceRules(): array
{
    return [

        'selected_services.*.service_name' => 'nullable|string|max:255',
    ];
}
        public function ndisRules(): array
        {
            return [
                'ndis_plan_approved'              => 'nullable|in:Yes,No,Pending',
                'ndis_number'                     => 'nullable|string|max:50',
                'ndis_plan_start_date'           => 'nullable|date',
                'ndis_plan_end_date'             => 'nullable|date|after_or_equal:ndis_plan_start_date',

                'plan_manager_name'              => 'nullable|string|max:255',
                'plan_manager_contact_mobile'    => 'nullable|string|max:255',
                'plan_manager_contact_email'    => 'nullable|string|email|max:255',

                'plan_type'                      => 'nullable|in:Plan Managed,Agency Managed,Self-Managed',
                'copy_of_plan_provided'          => 'nullable|in:Yes,No',
                'reason_plan_not_provided'       => 'nullable|required_if:copy_of_plan_provided,No|string',

                'engagement_concerns'            => 'nullable|in:Yes,No,Not Sure',
                'engagement_concerns_description'=> 'nullable|required_if:engagement_concerns,Yes|string',
            ];
        }
                public function medicalRules(): array
        {
            return [
                'primary_disability' => 'nullable|string|max:255',
                'secondary_disability' => 'nullable|string|max:255',
                'requires_high_intensity_support' => 'boolean',

                'complex_bowel_care' => 'boolean',
                'enteral_feeding' => 'boolean',
                'tracheostomy_care' => 'boolean',
                'urinary_catheters' => 'boolean',
                'ventilation' => 'boolean',
                'subcutaneous_injection' => 'boolean',

                'communication_method' => 'nullable|string|max:255',
                'communication_assessment' => 'nullable|in:Completed and Attached,Not Available',
                'occupational_therapy_assessment' => 'nullable|in:Completed and Attached,Not Available',

                'hoisting' => 'boolean',
                'assisted_devices' => 'boolean',
                'mobility_other' => 'nullable|string|max:255',

                'hospital_bed' => 'boolean',
                'pressure_mattresses' => 'boolean',
                'equipment_other' => 'nullable|string|max:255',

                'challenging_behaviours' => 'nullable|string',
                'pbsp_attached' => 'nullable|boolean',
                'pbsp_required' => 'nullable|boolean',
                'pbsp_review_requested' => 'nullable|boolean',

                'behaviour_support_practitioner_contact' => 'nullable|string|max:255',
            ];
        }

        public function housingRules(): array
    {
        return [
            'most_recent_housing' => 'nullable|string',
            'prior_housing' => 'nullable|string',

            'mental_health_service' => 'boolean',
            'aboriginal_service' => 'boolean',
            'communities_and_justice' => 'boolean',
            'family_violence' => 'boolean',
            'correctional_service' => 'boolean',
            'child_protection' => 'boolean',
            'drug_alcohol_rehabilitation' => 'boolean',
            'other_services_involved' => 'boolean',
            'other_services_description' => 'nullable|string',

            'services_background_info' => 'nullable|string',
            'services_contact_details' => 'nullable|string',

            'issue_mental_health' => 'boolean',
            'issue_drug_alcohol' => 'boolean',
            'issue_family_violence' => 'boolean',
            'issue_police_involvement' => 'boolean',
            'issue_child_protection' => 'boolean',
            'issue_child_custody' => 'boolean',
            'issue_other_description' => 'nullable|string',
        ];
    }
     public function rosterRules(): array
    {
        return [
            'need_bhc_community_support' => 'nullable|boolean',
            'comments' => 'nullable|string',
            'transport_funding' => 'nullable|numeric|min:0',
        ];
    }
     public function goalRules(): array
    {
        return [
            'ndis_goals' => 'required|array|min:1',
            'ndis_goals.*.goal' => 'nullable|string|max:255',
            'ndis_goals.*.barriers' => 'nullable|string',


        ];
    }
        private function independentLivingRules(): array
    {
        return [
            'rent_per_week'           => 'nullable|numeric|min:0',
            'utilities_per_week'      => 'nullable|numeric|min:0',
            'needs_furnished'         => 'boolean',
            'owns_furniture'          => 'boolean',
            'lease_duration'          => 'nullable|string|max:255',
            'can_pay_bond_upfront'    => 'boolean',
            'preferred_location'      => 'nullable|string|max:255',
            'living_preference'       => 'nullable|in:On Your Own,Share',
        ];
    }

    private function finalDeclarationRules(): array
{
    return [
        'primary_email'          => 'nullable|email|max:255',
        'secondary_email'        => 'nullable|email|max:255',

        'referrer_date'          => 'nullable|date',
        'referrer_name'          => 'nullable|string|max:255',
        'referrer_signature'     => 'nullable|string|max:255',
        'referrer_organisation'  => 'nullable|string|max:255',

        'client_date'            => 'nullable|date',
        'client_name'            => 'nullable|string|max:255',
        'client_signature'       => 'nullable|string|max:255',

        'guardian_date'          => 'nullable|date',
        'guardian_name'          => 'nullable|string|max:255',
        'guardian_signature'     => 'nullable|string|max:255',
    ];
}

}
