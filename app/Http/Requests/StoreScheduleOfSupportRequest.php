<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreScheduleOfSupportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
{
    if (is_string($this->funded_supports)) {
        $this->merge([
            'funded_supports' => json_decode($this->funded_supports, true),
        ]);
    }

    if (is_string($this->unfunded_supports)) {
        $this->merge([
            'unfunded_supports' => json_decode($this->unfunded_supports, true),
        ]);
    }
}

    public function rules(): array
    {
        return array_merge(
            $this->schedulerules(),
            $this->transportrules(),
            $this->unfundedrules(),
            $this->agreementrules(),

        );
    }

    private function schedulerules(): array
    {
        return [
            'user_id' => 'nullable|integer',
            'client_type' => 'required|in:1,2',

            'participant_name' => 'nullable|string|max:255',
            'creation_date' => 'nullable|date',
            'funding_review_date' => 'nullable|date',

            'support_on_public_holiday' => 'boolean',
            'sil_section_flag' => 'boolean',

            'form_status' => 'nullable|string|in:in_progress,completed,draft',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
        ];
    }

    private function transportrules(): array
    {
        return [

            'funded_supports' => 'nullable|array',
            'funded_supports.*' => 'array',

            'funded_supports.*.support_name' => 'nullable|string',
            'funded_supports.*.goal_key' => 'nullable|string',
            'funded_supports.*.description' => 'nullable|string',
            'funded_supports.*.price' => 'nullable|numeric',
            'funded_supports.*.unit' => 'nullable|numeric',
            
            'funded_supports.*.payment_information' => 'nullable|string',
            'funded_supports.*.invoicing_details' => 'nullable|string',
            'funded_supports.*.delivery_details' => 'nullable|string',
            'funded_supports.*.grand_total' => 'nullable|numeric',
            ];
    }

    private function unfundedrules(): array
    {
        return [

           'unfunded_supports' => 'nullable|array',
            'unfunded_supports.*' => 'array',

            'unfunded_supports.*.unfunded_support_name' => 'nullable|string',
            'unfunded_supports.*.goal_key' => 'nullable|string',
            'unfunded_supports.*.unfunded_description' => 'nullable|string',
            'unfunded_supports.*.unfunded_price_information' => 'nullable|string',
            'unfunded_supports.*.unfunded_delivery_details' => 'nullable|string',
            'unfunded_supports.*.unfunded_price' => 'nullable|numeric',
            'unfunded_supports.*.unfunded_unit' => 'nullable|numeric',
           
            'unfunded_supports.*.unfunded_grand_total' => 'nullable|numeric',
            ];

    }

    private function agreementrules(): array
    {
        return [


            'participant_signature' => 'nullable',
            'agreement_participant_name' => 'nullable|string|max:255',
            'participant_date' => 'nullable|date',

            'representative_signature' => 'nullable',
            'representative_name' => 'nullable|string|max:255',
            'representative_date' => 'nullable|date',
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
