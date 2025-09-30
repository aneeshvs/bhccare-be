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
