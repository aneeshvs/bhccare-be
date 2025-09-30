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
