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

            protected function prepareForValidation()
        {
            if (is_string($this->sil_goals)) {
                $this->merge([
                    'sil_goals' => json_decode($this->sil_goals, true),
                ]);
            }


        if (is_string($this->support_coordination_goals)) {
            $this->merge([
                'support_coordination_goals' => json_decode($this->support_coordination_goals, true),
            ]);
        }
    }





     public function rules()
    {
        return array_merge(
            $this->consentrules(),
            $this->alternativerules(),
            $this->silrules(),
            $this->goalsrules(),






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
    private function silrules():array
    {
        return [
        'sil_goals' => 'nullable|array',
        'sil_goals.*.category' => 'required|in:sil,support_coordination,homecare',
        'sil_goals.*.goal_title' => 'nullable|string|max:255',
        'sil_goals.*.goals_of_support' => 'nullable|string',

        'sil_goals.*.steps' => 'nullable|string',
        'sil_goals.*.organisation_steps' => 'nullable|string',
        'sil_goals.*.risk' => 'nullable|string',
        'sil_goals.*.risk_management_strategies' => 'nullable|string',
        'sil_goals.*.goal_key' => 'nullable|string|max:255',
    ];
    }


    private function goalsrules(): array
    {
        return [

            'support_coordination_goals' => 'nullable|array',
            'support_coordination_goals.*.goal_title' => 'nullable|string|max:255',
            'support_coordination_goals.*.goals_of_support' => 'nullable|string',
            'support_coordination_goals.*.steps' => 'nullable|string',
            'support_coordination_goals.*.organisation_steps' => 'nullable|string',
            'support_coordination_goals.*.risk' => 'nullable|string',
            'support_coordination_goals.*.risk_management_strategies' => 'nullable|string',
            'support_coordination_goals.*.goal_key' => 'nullable|string|max:255',
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
