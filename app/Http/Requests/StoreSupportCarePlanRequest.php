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

            if (is_string($this->emergency_contacts)) {
                $this->merge([
                    'emergency_contacts' => json_decode($this->emergency_contacts, true),
                ]);
            }
            foreach (['helps_me_talk', 'helps_me_understand', 'please_communicate_by'] as $field) {
                if (is_string($this->$field)) {
                    $this->merge([
                        $field => json_decode($this->$field, true),
                    ]);
                }
            }
        }






     public function rules()
    {
        return array_merge(
            $this->consentrules(),
            $this->alternativerules(),
            $this->silrules(),
            $this->goalsrules(),
            $this->communicationrules(),
            $this->disasterrules(),
            $this->contactrules(),
            $this->importantContactsRules(),
            $this->localrules(),
            $this->emergencyScenariosRules(),






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
            'consents_goal_plan_review_date' => 'nullable|date',

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
    private function communicationrules(): array
    {
        return [

            // 'helps_me_talk' => 'nullable|array',
            'helps_me_talk.*' => 'string|in:Interpreter,Symbols,Pictures,Gesturing,Facial Expressions,Simple words,When you wait for me to respond,My Supporter/carer,Other (Including Assistive technology)',

            // 'helps_me_understand' => 'nullable|array',
            'helps_me_understand.*' => 'string|in:Short plain sentences,Simple words,Concrete examples,Diagrams or pictures,Checking to see if I understand,Asking me to explain it,Asking my supporter/carer to explain it to me,Using real objects,Giving me a demonstration,Other',

            // 'please_communicate_by' => 'nullable|array',
            'please_communicate_by.*' => 'string|in:Speaking directly to me,Taking time to tell me,Waiting for me to respond,Writing down notes in my care plan,Knowing I cannot talk but can hear and understand,Other',

            'emergency_communication' => 'nullable|string|max:2000',
        ];
    }

    private function disasterrules(): array
    {
        return [

            'participant_name'     => 'nullable|string|max:255',
            'date'                 => 'nullable|date',
            'review_date'          => 'nullable|date',
            'user_id'              => 'nullable|integer', // for activity log
        ];
    }

    public function contactrules(): array
    {
        return [

            'emergency_contacts'             => 'nullable|array',

            'emergency_contacts.*.name'      => 'nullable|string|max:255',
            'emergency_contacts.*.relationship' => 'nullable|string|max:255',
            'emergency_contacts.*.phone'     => 'nullable|string',
            'emergency_contacts.*.email'     => 'nullable|email|max:255',
            'emergency_contacts.*.location'  => 'nullable|string|max:255',
            'emergency_contacts.*.goal_key' => 'nullable|string|max:255',
        ];
    }

    private function importantContactsRules(): array
{
    return [
        'advocate'                  => 'nullable|string|max:255',
        'childcare_school_contact'  => 'nullable|string|max:255',
        'power_of_attorney_guardian'=> 'nullable|string|max:255',
        'workplace_volunteer_contact'=> 'nullable|string|max:255',
        'landlord_sda_provider'     => 'nullable|string|max:255',
        'doctor'                    => 'nullable|string|max:255',
        'specialist_practitioner'   => 'nullable|string|max:255',
        'solicitor'                 => 'nullable|string|max:255',
        'insurer_home_contents'     => 'nullable|string|max:255',
        'private_health_cover'      => 'nullable|string|max:255',
        'insurer_vehicle'           => 'nullable|string|max:255',
    ];
}

private function localrules(): array
    {
        return [
            'council'     => 'nullable|string|max:255',
            'hospital'    => 'nullable|string|max:255',
            'electricity' => 'nullable|string|max:255',
            'water'       => 'nullable|string|max:255',
        ];
    }

    private function emergencyScenariosRules(): array
{
    return [
        'admitted_to_hospital'                  => 'nullable|boolean',
        'admitted_to_hospital_action'           => 'nullable|string|max:2000',
        'medical_emergencies'                   => 'nullable|boolean',
        'medical_emergencies_action'            => 'nullable|string|max:2000',
        'other_likely_medical_emergency'        => 'nullable|boolean',
        'other_likely_medical_emergency_action' => 'nullable|string|max:2000',
        'natural_disaster'                      => 'nullable|boolean',
        'natural_disaster_action'               => 'nullable|string|max:2000',
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
