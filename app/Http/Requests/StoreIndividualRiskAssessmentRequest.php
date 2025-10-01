<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreIndividualRiskAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorize all for now (you can add policies later)
    }

       protected function prepareForValidation()
        {


            if (is_string($this->manual_handlings)) {
                $this->merge([
                    'manual_handlings' => json_decode($this->manual_handlings, true),
                ]);
            }

        }



    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return array_merge(
            $this->baseRules(),
            $this->detailsrules(),
            $this->communicationrules(),
            $this->cognitionrules(),
            $this->mobilityrules(),
            $this->carerules(),
            $this->manualHandlingRules(),
            $this->violencerules(),

        );
    }

    /**
     * Basic fields (meta + tracking)
     */
    private function baseRules(): array
    {
        return [
            'user_id' => 'nullable|integer',
            'client_type' => 'required|in:1,2',



            // Risk Assessment fields
            'client_name'          => 'nullable|string|max:255',
            'site_address'         => 'nullable|string|max:255',
            'assessment_date'      => 'nullable|date',
            'planned_review_date'  => 'nullable|date|after_or_equal:assessment_date',


            'form_status' => 'nullable|string|in:in_progress,completed,draft',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
        ];
    }

    private function detailsrules(): array
    {
        return [

            'vulnerability'                 => 'nullable|in:high,medium,low',
            'review_frequency'              => 'nullable|in:3_months,6_months,12_months',
            'dependent_on_homecare'         => 'nullable|boolean',

        ];
    }

    private function communicationrules(): array
    {
        return [

            'hearing_impairment'            => 'nullable|boolean',
            'hearing_hazards'               => 'nullable|string|max:2000',
            'hearing_management_plan'       => 'nullable|string|max:2000',
            'speech_impairment'             => 'nullable|boolean',
            'speech_hazards'                => 'nullable|string|max:2000',
            'speech_management_plan'        => 'nullable|string|max:2000',
        ];
    }

    private function cognitionrules(): array
    {
        return [

            'oriented_in_time_place' => 'nullable|boolean',
            'oriented_hazards' => 'nullable|string|max:2000',
            'oriented_management_plan' => 'nullable|string|max:2000',

            'accepts_direction' => 'nullable|boolean',
            'direction_hazards' => 'nullable|string|max:2000',
            'direction_management_plan' => 'nullable|string|max:2000',

            'short_term_memory_issues' => 'nullable|boolean',
            'memory_hazards' => 'nullable|string|max:2000',
            'memory_management_plan' => 'nullable|string|max:2000',
        ];
    }

    private function mobilityrules(): array
    {
        return [

            'walk_unaided' => 'nullable|boolean',
            'accessibility_required' => 'nullable|boolean',
            'walk_hazards' => 'nullable|string|max:2000',
            'walk_management_plan' => 'nullable|string|max:2000',

            'manages_stairs' => 'nullable|boolean',
            'stairs_hazards' => 'nullable|string|max:2000',
            'stairs_management_plan' => 'nullable|string|max:2000',

            'uses_walking_aid' => 'nullable|boolean',
            'walking_aid_hazards' => 'nullable|string|max:2000',
            'walking_aid_management_plan' => 'nullable|string|max:2000',

            'uses_wheelchair' => 'nullable|boolean',
            'wheelchair_hazards' => 'nullable|string|max:2000',
            'wheelchair_management_plan' => 'nullable|string|max:2000',

            'bed_transfer' => 'nullable|boolean',
            'bed_transfer_hazards' => 'nullable|string|max:2000',
            'bed_transfer_management_plan' => 'nullable|string|max:2000',

            'vehicle_transfer' => 'nullable|boolean',
            'vehicle_transfer_hazards' => 'nullable|string|max:2000',
            'vehicle_transfer_management_plan' => 'nullable|string|max:2000',

            'toilet_transfer' => 'nullable|boolean',
            'toilet_transfer_hazards' => 'nullable|string|max:2000',
            'toilet_transfer_management_plan' => 'nullable|string|max:2000',
        ];
    }

    private function carerules(): array
    {
        return [

            'showering' => 'nullable|boolean',
            'showering_hazards' => 'nullable|string',
            'showering_management_plan' => 'nullable|string',

            'meal' => 'nullable|boolean',
            'meal_hazards' => 'nullable|string',
            'meal_management_plan' => 'nullable|string',

            'toileting' => 'nullable|boolean',
            'toileting_hazards' => 'nullable|string',
            'toileting_management_plan' => 'nullable|string',

            'grooming' => 'nullable|boolean',
            'grooming_hazards' => 'nullable|string',
            'grooming_management_plan' => 'nullable|string',

            'repositioning_bed' => 'nullable|boolean',
            'repositioning_bed_hazards' => 'nullable|string',
            'repositioning_bed_management_plan' => 'nullable|string',

            'repositioning_chair' => 'nullable|boolean',
            'repositioning_chair_hazards' => 'nullable|string',
            'repositioning_chair_management_plan' => 'nullable|string',

            'mouthcare' => 'nullable|boolean',
            'mouthcare_hazards' => 'nullable|string',
            'mouthcare_management_plan' => 'nullable|string',

            'skin_care' => 'nullable|boolean',
            'skin_care_hazards' => 'nullable|string',
            'skin_care_management_plan' => 'nullable|string',
        ];
    }

    private function manualHandlingRules(): array
{
    return [
        'manual_handlings'                              => 'nullable|array',

        'manual_handlings.*.goal_key'                   => 'nullable|string|max:255',
        'manual_handlings.*.training_provided'          => 'nullable|boolean',
        'manual_handlings.*.training_hazards'           => 'nullable|string',
        'manual_handlings.*.training_management_plan'   => 'nullable|string',
        'manual_handlings.*.tasks_safe'                 => 'nullable|boolean',
        'manual_handlings.*.tasks_hazards'              => 'nullable|string',
        'manual_handlings.*.tasks_management_plan'      => 'nullable|string',
    ];
}


private function violencerules(): array
    {
        return [

            'physical_aggression' => 'boolean',
            'physical_hazards' => 'nullable|string',
            'physical_management_plan' => 'nullable|string',
            'physical_bsp_plan' => 'boolean',

            'verbal_aggression' => 'boolean',
            'verbal_hazards' => 'nullable|string',
            'verbal_management_plan' => 'nullable|string',
            'verbal_bsp_plan' => 'boolean',

            'client_aggression' => 'boolean',
            'client_hazards' => 'nullable|string',
            'client_management_plan' => 'nullable|string',
            'client_bsp_plan' => 'boolean',

            'self_harm' => 'boolean',
            'self_harm_hazards' => 'nullable|string',
            'self_harm_management_plan' => 'nullable|string',
            'self_harm_bsp_plan' => 'boolean',

            'drug_alcohol_use' => 'boolean',
            'drug_alcohol_hazards' => 'nullable|string',
            'drug_alcohol_management_plan' => 'nullable|string',
            'drug_alcohol_bsp_plan' => 'boolean',

            'sexual_abuse_history' => 'boolean',
            'sexual_abuse_hazards' => 'nullable|string',
            'sexual_abuse_management_plan' => 'nullable|string',
            'sexual_abuse_bsp_plan' => 'boolean',

            'emotional_manipulation' => 'boolean',
            'emotional_hazards' => 'nullable|string',
            'emotional_management_plan' => 'nullable|string',
            'emotional_bsp_plan' => 'boolean',

            'other_known_risks' => 'boolean',
            'other_risks_hazards' => 'nullable|string',
            'other_risks_management_plan' => 'nullable|string',
            'other_risks_bsp_plan' => 'boolean',

            'finance_management' => 'boolean',
            'finance_hazards' => 'nullable|string',
            'finance_management_plan' => 'nullable|string',
            'finance_bsp_plan' => 'boolean',
        ];
    }






    /**
     * Handle failed validation
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ], 422));
    }
}
