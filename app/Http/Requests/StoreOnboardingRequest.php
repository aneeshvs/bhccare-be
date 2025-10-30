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
            if (is_string($this->health_professional_details)) {
                $this->merge(['health_professional_details' => json_decode($this->health_professional_details, true)]);
            }
            if (is_string($this->health_conditions)) {
                $this->merge([
                    'health_conditions' => json_decode($this->health_conditions, true),
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
            $this->healthProfessionalRules(),
            $this->diagnosisRules(),
            $this->healthInformationRules(),
            $this->healthcareSupportRules(),
            $this->behaviourSupportRules(),
            $this->medicalAlertRules(),
            $this->preventiveHealthRules(),
            $this->supportInformationRules(),



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
            'support_person_details' => 'nullable|string',
            'user_id' => 'required|integer',
            'client_type' => 'required|in:1,2',
        ];
    }
        private function fundingRules(): array
    {
        return [
            'type_of_funding' => 'nullable|in:Self-Managed,NDIA,Plan Managed',
            'funding_contact_person' => 'nullable|string|max:255',
            'ndis_plan_attached' => 'nullable|boolean',
            'ndis_plan_start_date' => 'nullable|date',
            'ndis_plan_end_date' => 'nullable|date',
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
        'schedule_of_cares.*.goal_key' => 'nullable|string|max:255',
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
                    'ndis_goals_onboarding.*.goal_key' => 'nullable|string|max:255', // ✅ Add this
                ];
            }

        private function healthProfessionalRules(): array
        {
            return [
                'health_professional_details' => 'nullable|array',
                'health_professional_details.*.role' => 'nullable|string|max:255',
                'health_professional_details.*.name' => 'nullable|string|max:255',
                'health_professional_details.*.contact_number' => 'nullable|string|max:20',
            ];
        }
        private function diagnosisRules(): array
        {
            return [
                'primary_diagnosis' => 'nullable|string|max:255',
                'secondary_diagnosis' => 'nullable|string|max:255',
            ];
        }
        private function healthInformationRules(): array
        {
            return [
                'health_conditions' => 'nullable|array',
                'health_conditions.*' => 'string|in:Urinary Catheter Management,Intellectual Disability,Spinal Cord Disability/Injury,Bowel Care,Wound Care / Pressure Area Care,Hearing Impairment,Tracheostomy Management,Cerebral Palsy,Subcutaneous Medication Management,Mealtime Support or Dysphagia,Enteral Feeding or Peg Feeding,Ventilator,Medication Support,Other',
            ];
        }



                private function healthcareSupportRules(): array
        {
            return [
                'medicare' => 'nullable|string|max:255',
                'health_fund' => 'nullable|string|max:255',
                'pension_card_number' => 'nullable|string|max:255',
                'health_care_card' => 'nullable|string|max:255',
                'dva_type' => 'nullable|string|max:255',
                'dva_number' => 'nullable|string|max:255',
                'companion_card' => 'nullable|string|max:255',
                'preferred_hospital' => 'nullable|string|max:255',
                'ambulance_number' => 'nullable|string|max:255',
                'disabled_parking' => 'nullable|string|max:255',
            ];
        }
                private function behaviourSupportRules(): array
        {
            return [
                'has_support_plan' => 'nullable|boolean',
                'plan_copy_received' => 'nullable|boolean',
            ];
        }
                private function medicalAlertRules(): array
        {
            return [
                'epilepsy' => 'nullable|boolean',
                'asthma' => 'nullable|boolean',
                'diabetes' => 'nullable|boolean',
                'allergies' => 'nullable|string|max:1000',
                'medical_info' => 'nullable|string|max:2000',
                'diagnosis' => 'nullable|string|max:2000',
                'other_description' => 'nullable|string|max:2000',
                'medication_taken' => 'nullable|string|max:2000',
                'medication_purpose' => 'nullable|string|max:2000',
                'staff_administer_medication' => 'nullable|boolean',

                 'self_administered' => 'nullable|boolean',
                 'guardian' => 'nullable|boolean',
                 'support_worker' => 'nullable|boolean',

            ];
        }
        private function preventiveHealthRules(): array
        {
            return [
                'medical_checkup_status' => 'nullable|string|max:2000',
                'last_dental_check' => 'nullable|date',
                'last_hearing_check' => 'nullable|date',
                'last_vision_check' => 'nullable|date',
                'requires_vaccination_assistance' => 'nullable|boolean',
            ];
        }
        private function supportInformationRules(): array
        {
            return [

                'communication_assistance_required' => 'nullable|boolean',
                'mealtime_plan' => 'nullable|string|max:2000',
                'likes' => 'nullable|string|max:1000',
                'dislikes' => 'nullable|string|max:1000',
                'interests' => 'nullable|string|max:1000',

                 'male' => 'nullable|boolean',
                 'female' => 'nullable|boolean',
                 'no_preference' => 'nullable|boolean',


                'special_request' => 'nullable|string|max:2000',
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
