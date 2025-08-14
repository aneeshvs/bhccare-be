<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupportPlanRequest extends FormRequest
{

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
            'gender' => 'nullable|string|max:50',
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
