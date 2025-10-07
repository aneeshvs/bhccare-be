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

        );
    }

    private function schedulerules(): array
    {
        return [
            'user_id' => 'nullable|integer',
            'client_type' => 'required|in:1,2',

            'participant_name' => 'nullable|string|max:255',
            'creation_date' => 'nullable|date',
            'funding_review_date' => 'nullable|date|after_or_equal:creation_date',

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

            'support_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_information' => 'nullable|string|max:255',
            'delivery_details' => 'nullable|string',
            'price' => 'nullable|numeric',
            'grand_total' => 'nullable|numeric',
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
