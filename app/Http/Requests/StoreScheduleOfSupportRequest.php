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

            'form_status' => 'nullable|string|in:in_progress,completed,draft',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
        ];
    }

    private function transportrules(): array
    {
        return [

            'support_name'           => 'nullable|string',
            'description'            => 'nullable|string',
            'price'                  => 'nullable| numeric',
            'payment_information'    => 'nullable| string',
            'invoicing_details'      => 'nullable| string',
            'delivery_details'       => 'nullable| string',
            'grand_total'            =>  'nullable| numeric',
        ];
    }

    private function unfundedrules(): array
    {
        return [

            'unfunded_support_name' => 'nullable|string|max:255',
            'unfunded_description' => 'nullable|string',
            'unfunded_price_information' => 'nullable|string|max:255',
            'unfunded_delivery_details' => 'nullable|string',
            'unfunded_price' => 'nullable|numeric',
            'unfunded_grand_total' => 'nullable|numeric',
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
