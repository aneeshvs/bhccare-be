<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreHomeSafetyChecklistAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->homerules(),
            $this->outsiderules(),
            $this->insiderules(),


        );
    }


    private function homerules(): array
    {
        return [
            'user_id' => 'required|integer',
            'client_type' => 'required|integer',

            'participant_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',

            'is_new_participant' => 'nullable|boolean',
            'is_review_existing' => 'nullable|boolean',
            'does_participant_agree' => 'nullable|boolean',

            'entry_door' => 'nullable|string|in:front,side,rear,other',
            'entry_door_other' => 'nullable|string|max:255',

            'form_status' => 'nullable|string',
        ];
    }

    private function outsiderules(): array
    {
        return [

            'parking_adequate' => 'nullable|in:Yes,No,N/A,Unsure',
            'parking_adequate_strategy' => 'nullable|string|max:1000',
            'pathway_surface' => 'nullable|in:Yes,No,N/A,Unsure',
            'pathway_surface_strategy' => 'nullable|string|max:1000',
            'gates_entry_easy' => 'nullable|in:Yes,No,N/A,Unsure',
            'gates_entry_easy_strategy' => 'nullable|string|max:1000',
            'lighting_adequate' => 'nullable|in:Yes,No,N/A,Unsure',
            'lighting_adequate_strategy' => 'nullable|string|max:1000',
            'outdoor_fire_hazards' => 'nullable|in:Yes,No,N/A,Unsure',
            'outdoor_fire_hazards_strategy' => 'nullable|string|max:1000',
        ];
    }

    private function insiderules(): array
    {
        return [

            'exit_doors_unobstructed' => 'nullable|in:Yes,No,N/A,Unsure',
            'exit_doors_unobstructed_strategy' => 'nullable|string|max:1000',
            'heaters_suitable' => 'nullable|in:Yes,No,N/A,Unsure',
            'heaters_suitable_strategy' => 'nullable|string|max:1000',
            'aids_equipment_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'aids_equipment_condition_strategy' => 'nullable|string|max:1000',
            'evidence_of_pests' => 'nullable|in:Yes,No,N/A,Unsure',
            'evidence_of_pests_strategy' => 'nullable|string|max:1000',
            'participant_open_door' => 'nullable|in:Yes,No,N/A,Unsure',
            'participant_open_door_strategy' => 'nullable|string|max:1000',
            'fire_hazards' => 'nullable|in:Yes,No,N/A,Unsure',
            'fire_hazards_strategy' => 'nullable|string|max:1000',
            'vacuum_cleaner_ok' => 'nullable|in:Yes,No,N/A,Unsure',
            'vacuum_cleaner_ok_strategy' => 'nullable|string|max:1000',
            'mop_bucket_ok' => 'nullable|in:Yes,No,N/A,Unsure',
            'mop_bucket_ok_strategy' => 'nullable|string|max:1000',
            'step_ladder_ok' => 'nullable|in:Yes,No,N/A,Unsure',
            'step_ladder_ok_strategy' => 'nullable|string|max:1000',
            'cleaning_substances_ok' => 'nullable|in:Yes,No,N/A,Unsure',
            'cleaning_substances_ok_strategy' => 'nullable|string|max:1000',
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
