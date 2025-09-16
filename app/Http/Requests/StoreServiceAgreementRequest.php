<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreServiceAgreementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // adjust if you want authorization logic
    }

    public function rules()
    {
        return array_merge(
            $this->agreementrules(),
            $this->conscentrules(),






        );
    }

    private function agreementrules(): array
    {
        return [

            'user_id' => 'nullable|integer',
            'client_type' => 'required|in:1,2',

            // ✅ Participant fields
            'participant_name' => 'nullable|string|max:255',
            'ndis_number' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'contact' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'ndis_plan_start_date' => 'nullable|date',
            'ndis_plan_end_date' => 'nullable|date|after_or_equal:ndis_plan_start_date',
            'term_start_date' => 'nullable|date',
            'term_end_date' => 'nullable|date|after_or_equal:term_start_date',
            'area_of_support' => 'nullable|string|max:255',

            // ✅ Representative fields
            'representative_name' => 'nullable|string|max:255',
            'representative_relationship' => 'nullable|string|max:255',
            'representative_contact' => 'nullable|string|max:50',
            'representative_email' => 'nullable|email|max:255',

            // ✅ Form tracking
            'form_status' => 'nullable|string|in:in_progress,completed,draft',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
        ];
    }

    public function conscentrules(): array
    {
        return [


            // ✅ Agreement Accepted & Signed
            'accepted_name'       => 'nullable|string|max:255',
            'accepted_position'   => 'nullable|string|max:255',
            'accepted_signature'  => 'nullable|string', // can be base64 or file path
            'accepted_date'       => 'nullable|date',

            // ✅ Written Participant Consent
            'consents_participant_name'     => 'nullable|string|max:255',
            'participant_role'     => 'nullable|in:participant,representative',
            'participant_signature'=> 'nullable|string',
            'participant_date'     => 'nullable|date',

            'witness_name'         => 'nullable|string|max:255',
            'witness_signature'    => 'nullable|string',
            'witness_date'         => 'nullable|date',

            // ✅ Verbal Participant Consent
            'verbal_staff_name'     => 'nullable|string|max:255',
            'verbal_staff_signature'=> 'nullable|string',
            'verbal_staff_position' => 'nullable|string|max:255',
            'verbal_date'           => 'nullable|date',

            // ✅ Other Notes
            'other_notes' => 'nullable|string|max:2000',

            // ✅ Office Use
            'received_signed_copy' => 'nullable|in:yes,no',
            'agreed_verbally'      => 'nullable|in:yes,no',
            'cms_comments_entered' => 'nullable|in:yes,no',
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
