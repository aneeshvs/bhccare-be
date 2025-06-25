<?php
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
            $this->serviceRules()


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
            'mobile'                => 'required|string|max:15',
            'email'                 => 'nullable|email|max:255',
            'atsi_status'           => 'required|in:Aboriginal,Torres Strait Islander,Neither,Both',
            'cultural_background'   => 'nullable|string',
            'language_spoken'       => 'nullable|string',
            'interpreter_required'  => 'boolean',

            'guardian_name'             => 'nullable|string|max:255',
            'is_public_guardian'        => 'boolean',
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
        'selected_services' => 'required|array|min:1',
        'selected_services.*.service_name' => 'nullable|string|max:255',
    ];
}



}
