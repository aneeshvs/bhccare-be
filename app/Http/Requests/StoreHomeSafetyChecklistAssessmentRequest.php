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
            $this->hallwaysrules(),
            $this->kitchenrules(),
            $this->assesmentrules(),
             $this->miscerules(),


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

    private function hallwaysrules(): array
    {
        return [

            'hallways_lounge_dining_bedroom' => 'nullable|in:Yes,No,N/A,Unsure',
            'hallways_lounge_dining_bedroom_strategy' => 'nullable|string|max:1000',
            'pests_evidence' => 'nullable|in:Yes,No,N/A,Unsure',
            'pests_evidence_strategy' => 'nullable|string|max:1000',
            'lighting_workspace' => 'nullable|in:Yes,No,N/A,Unsure',
            'lighting_workspace_strategy' => 'nullable|string|max:1000',
            'furniture_stable' => 'nullable|in:Yes,No,N/A,Unsure',
            'furniture_stable_strategy' => 'nullable|string|max:1000',
            'bed_adjustable' => 'nullable|in:Yes,No,N/A,Unsure',
            'bed_adjustable_strategy' => 'nullable|string|max:1000',
            'electrical_switches' => 'nullable|in:Yes,No,N/A,Unsure',
            'electrical_switches_strategy' => 'nullable|string|max:1000',
            'private_sleep_space' => 'nullable|in:Yes,No,N/A,Unsure',
            'private_sleep_space_strategy' => 'nullable|string|max:1000',
            'hallways_fire_hazards' => 'nullable|in:Yes,No,N/A,Unsure',
            'hallways_fire_hazards_strategy' => 'nullable|string|max:1000',
        ];
    }

    private function kitchenrules(): array
    {
        return [

            'floor_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'floor_condition_strategy' => 'nullable|string|max:1000',

            'electrical_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'electrical_condition_strategy' => 'nullable|string|max:1000',

            'ventilation_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'ventilation_condition_strategy' => 'nullable|string|max:1000',

            'bench_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'bench_condition_strategy' => 'nullable|string|max:1000',

            'stove_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'stove_condition_strategy' => 'nullable|string|max:1000',

            'fridge_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'fridge_condition_strategy' => 'nullable|string|max:1000',

            'bath_access' => 'nullable|in:Yes,No,N/A,Unsure',
            'bath_access_strategy' => 'nullable|string|max:1000',

            'toilet_access' => 'nullable|in:Yes,No,N/A,Unsure',
            'toilet_access_strategy' => 'nullable|string|max:1000',

            'privacy_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'privacy_condition_strategy' => 'nullable|string|max:1000',

            'laundry_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'laundry_condition_strategy' => 'nullable|string|max:1000',

            'ironing_condition' => 'nullable|in:Yes,No,N/A,Unsure',
            'ironing_condition_strategy' => 'nullable|string|max:1000',

            'manual_handling_risks' => 'nullable|in:Yes,No,N/A,Unsure',
            'manual_handling_strategy' => 'nullable|string|max:1000',

            'kitchen_fire_hazards' => 'nullable|in:Yes,No,N/A,Unsure',
            'kitchen_fire_hazards_strategy' => 'nullable|string|max:1000',
        ];
    }

    private function assesmentrules(): array
    {
        return [


        'outside_paths_veranda_steps' => 'nullable|in:Yes,No,N/A,Unsure',
        'outside_paths_veranda_steps_strategy' => 'nullable|string',

        'outside_pets_restrained' => 'nullable|in:Yes,No,N/A,Unsure',
        'outside_pets_restrained_strategy' => 'nullable|string',

        'outside_lighting_adequate' => 'nullable|in:Yes,No,N/A,Unsure',
        'outside_lighting_adequate_strategy' => 'nullable|string',

        'outside_door_easy_open' => 'nullable|in:Yes,No,N/A,Unsure',
        'outside_door_easy_open_strategy' => 'nullable|string',

        'outside_lawn_mower_condition' => 'nullable|in:Yes,No,N/A,Unsure',
        'outside_lawn_mower_condition_strategy' => 'nullable|string',

        'outside_electrical_condition' => 'nullable|in:Yes,No,N/A,Unsure',
        'outside_electrical_condition_strategy' => 'nullable|string',

        'outside_fire_hazards' => 'nullable|in:Yes,No,N/A,Unsure',
        'outside_fire_hazards_strategy' => 'nullable|string'


       ];
    }


    private function miscerules(): array
    {
        return [


            'misc_children_living_at_home' => 'nullable|string|max:255',
            'misc_children_living_at_home_strategy' => 'nullable|string|max:1000',

            'misc_weapons_stored_appropriately' => 'nullable|string|max:255',
            'misc_weapons_stored_appropriately_strategy' => 'nullable|string|max:1000',

            'misc_smoking_outside_only' => 'nullable|string|max:255',
            'misc_smoking_outside_only_strategy' => 'nullable|string|max:1000',

            'misc_mobility_issues' => 'nullable|string|max:255',
            'misc_mobility_issues_strategy' => 'nullable|string|max:1000',

            'misc_equipment_good_condition' => 'nullable|string|max:255',
            'misc_equipment_good_condition_strategy' => 'nullable|string|max:1000',

            'misc_ppe_requirements' => 'nullable|string|max:255',
            'misc_ppe_requirements_strategy' => 'nullable|string|max:1000',

            'misc_personal_threats' => 'nullable|string|max:255',
            'misc_personal_threats_strategy' => 'nullable|string|max:1000',

            'misc_safe_neighbourhood' => 'nullable|string|max:255',
            'misc_safe_neighbourhood_strategy' => 'nullable|string|max:1000',

            'misc_aggression_in_home' => 'nullable|string|max:255',
            'misc_aggression_in_home_strategy' => 'nullable|string|max:1000',
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
