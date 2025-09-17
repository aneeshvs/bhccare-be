<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSupportCarePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

     public function rules()
    {
        return array_merge(
            $this->consentrules(),
            $this->alternativerules(),






        );
    }


    private function consentrules():array
    {
        return [
            'user_id' => 'nullable|integer',
            'client_type' => 'required|in:1,2',

            'consents_participant_first_name' => 'nullable|string|max:255',
            'consents_participant_surname' => 'nullable|string|max:255',
            'consents_participant_dob' => 'nullable|date',
            'consents_goal_plan_start_date' => 'nullable|date',
            'consents_goal_plan_review_date' => 'nullable|date|after_or_equal:consents_goal_plan_start_date',

            'form_status' => 'nullable|string|in:in_progress,completed,draft',
            'completion_percentage' => 'nullable|integer|min:0|max:100',


        ];
    }
    private function alternativerules():array
    {
        return [

                'type' => 'nullable|in:not_applicable,partner,carer,guardian,parent,advocacy,other',
                'first_name' => 'nullable|string|max:255',
                'surname' => 'nullable|string|max:255',
                'notes' => 'nullable|string|max:2000',
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
