<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreConfidentialInformationFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow all authenticated users (you can restrict by role if needed)
        return true;
    }



    public function rules(): array
    {
        return array_merge(
            $this->formrules(),
            $this->agenciesrules(),
            $this->concentrules(),



        );
    }

        protected function prepareForValidation()
        {
            if (is_string($this->agencies)) {
                $this->merge([
                    'agencies' => json_decode($this->agencies, true),
                ]);
            }


        }



    private function formrules(): array
    {
        return [
           'user_id' => 'required|integer',
            'client_type' => 'required|integer',

            'participant_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'post_code' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'mobile_no' => 'nullable|string|max:20',

           'form_status' => 'nullable|string',
        ];
    }

    private function agenciesrules(): array
{
    return [
         'agencies' => 'nullable|array',
        'agencies.*.goal_key' => 'nullable|string',
        'agencies.*.name' => 'nullable|string|max:255',
        'agencies.*.role' => 'nullable|string|max:255',
        'agencies.*.contact' => 'nullable|string|max:255',
        'agencies.*.agency_name' => 'nullable|string|max:255',
        'agencies.*.service_type' => 'nullable|string|max:255',
        'agencies.*.information_shared' => 'nullable|string',
    ];
}

private function concentrules(): array
    {
        return [

            'signature' => 'nullable|string',
            'signed_date' => 'nullable|date',
            'signed_by' => 'nullable|in:participant,authorized_rep',
            'name' => 'nullable|string|max:255',
            'witnessed_by' => 'nullable|string|max:255',
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
