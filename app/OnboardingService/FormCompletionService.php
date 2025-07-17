<?php
namespace App\OnboardingService;

use App\Models\InitialEnquiry;

class FormCompletionService
{
    private array $sectionFields = [
        'funding' => ['type_of_funding','funding_contact_person','ndis_plan_attached','ndis_plan_start_date', 'ndis_plan_end_date',
        'plan_manager_name','plan_manager_email','plan_manager_phone'],

        'emergencyContact' => [ 'name',
        'relationship',
        'phone',
        'mobile',
        'work_contact'],

        'scheduleOfCares' => ['type_of_service',
        'primary_task_list',
        'secondary_task_list'],

        'culturalBackground' => ['has_children_under_18',
        'country_of_birth',
        'preferred_language',
        'religion',
        'other_languages',
        'cultural_needs',
        'interpreter_required',
        'auslan_required'],

        'ndisGoals' => ['goal_description'],
        'healthProfessionalDetails' => [ 'role',
        'name',
        'contact_number'],

        'diagnosisSummary' => [ 'primary_diagnosis',
        'secondary_diagnosis'],

        'healthInformation' => ['health_conditions'],

        'healthcareSupportDetail' => [ 'medicare',
        'health_fund',
        'pension_card_number',
        'health_care_card',
        'dva_type',
        'dva_number',
        'companion_card',
        'preferred_hospital',
        'ambulance_number',
        'disabled_parking'],

        'behaviourSupport' => [ 'has_support_plan',
        'plan_copy_received'],

        'medicalAlert' => [ 'has_epilepsy',
        'has_asthma',
        'has_diabetes',
        'allergies',
        'medical_info',
        'diagnosis',
        'other_description',
        'medication_taken',
        'medication_purpose',
        'staff_administer_medication',
        'self_administered',
        'guardian',
        'support_worker'],

        'preventiveHealthSummary' => ['medical_checkup_status',
        'last_dental_check',
        'last_hearing_check',
        'last_vision_check',
        'requires_vaccination_assistance'],

        'supportInformation' => [ 'communication_assistance_required',
        'mealtime_plan',
        'likes',
        'dislikes',
        'interests',
        'male',
        'female',
        'no_preference',
        'special_request']
    ];

    public function calculate(InitialEnquiry $initial): int
    {
        $filledFields = 0;
        $totalFields = 0;

        foreach ($this->sectionFields as $relation => $fields) {
            $relatedData = $initial->$relation;

            if ($relatedData instanceof \Illuminate\Database\Eloquent\Collection) {
                foreach ($relatedData as $item) {
                    foreach ($fields as $field) {
                        $totalFields++;
                        if (!empty($item->$field)) {
                            $filledFields++;
                        }
                    }
                }
            } elseif ($relatedData) {
                foreach ($fields as $field) {
                    $totalFields++;
                    if (!empty($relatedData->$field)) {
                        $filledFields++;
                    }
                }
            } else {
                $totalFields += count($fields);
            }
        }

        return $totalFields > 0 ? (int) round(($filledFields / $totalFields) * 100) : 0;
    }
}
