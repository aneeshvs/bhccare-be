<?php //store full form request validation
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreOnboardingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // or implement your auth logic
    }
            protected function prepareForValidation()
                {
                if (is_string($this->schedule_of_cares)) {
                $this->merge([
                    'schedule_of_cares' => json_decode($this->schedule_of_cares, true),
                ]);
            }
            if (is_string($this->ndis_goals_onboarding)) {
                $this->merge([
                    'ndis_goals_onboarding' => json_decode($this->ndis_goals_onboarding, true),
                ]);
            }

        }

    public function rules()
    {
        return array_merge(
            $this->InitialenquiryRules(),
            $this->fundingRules(),
            $this->emergencyRules(),
            $this->scheduleRules(),
            $this->culturalRules(),
            $this->ndisRules(),



        );
    }

    private function InitialenquiryRules(): array
    {
        return [
            'full_name' => 'nullable|string|max:255',
            'preferred_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:20',
            'mobile_number' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'need_support_person' => 'nullable|boolean',
            'support_person_details' => 'nullable|string'
        ];
    }
        private function fundingRules(): array
    {
        return [
            'type_of_funding' => 'nullable|in:Self-Managed,NDIA,Plan Managed',
            'funding_contact_person' => 'nullable|string|max:255',
            'ndis_plan_attached' => 'nullable|boolean',
            'ndis_plan_start_date' => 'nullable|date',
            'ndis_plan_end_date' => 'nullable|date|after_or_equal:ndis_plan_start_date',
            'plan_manager_name' => 'nullable|string|max:255',
            'plan_manager_email' => 'nullable|email|max:255',
            'plan_manager_phone' => 'nullable|string|max:20',
        ];
    }
        private function emergencyRules(): array
        {
            return [

                'name' => 'nullable|string|max:255',
                'relationship' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'mobile' => 'nullable|string|max:20',
                'work_contact' => 'nullable|string|max:20',
            ];
        }
        private function scheduleRules(): array
        {
            return [

        'schedule_of_cares' => 'nullable|array',
        'schedule_of_cares.*.type_of_service' => 'nullable|string|max:255',
        'schedule_of_cares.*.primary_task_list' => 'nullable|string',
        'schedule_of_cares.*.secondary_task_list' => 'nullable|string',
            ];
        }
        private function culturalRules(): array
        {
            return [
            'has_children_under_18' => 'nullable|boolean',
            'country_of_birth' => 'nullable|string|max:255',
            'preferred_language' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'other_languages' => 'nullable|string|max:255',
            'cultural_needs' => 'nullable|string',
            'interpreter_required' => 'nullable|boolean',
            'auslan_required' => 'nullable|boolean',

                ];

        }
        private function ndisRules(): array
        {
            return [

        'ndis_goals_onboarding' => 'nullable|array',
        'ndis_goals_onboarding.*.goal_description' => 'nullable|string|max:1000',
            ];
        }


   protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['success' => false, 'status' => 400, 'message' => 'Invalid Format', 'data' => $errors, 'alert' => true], 200)
        );
    }
}
