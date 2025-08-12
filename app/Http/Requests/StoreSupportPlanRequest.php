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
