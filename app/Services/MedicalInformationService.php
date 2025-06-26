<?php
// app/Services/MedicalInformationService.php

namespace App\Services;

use App\Models\MedicalInformation;

class MedicalInformationService
{
    public function save(array $data): MedicalInformation
    {
        return MedicalInformation::create([
            'primary_disability' => $data['primary_disability'] ?? null,
            'secondary_disability' => $data['secondary_disability'] ?? null,
            'requires_high_intensity_support' => $data['requires_high_intensity_support'] ?? false,

            'complex_bowel_care' => $data['complex_bowel_care'] ?? false,
            'enteral_feeding' => $data['enteral_feeding'] ?? false,
            'tracheostomy_care' => $data['tracheostomy_care'] ?? false,
            'urinary_catheters' => $data['urinary_catheters'] ?? false,
            'ventilation' => $data['ventilation'] ?? false,
            'subcutaneous_injection' => $data['subcutaneous_injection'] ?? false,

            'communication_method' => $data['communication_method'] ?? null,
            'communication_assessment' => $data['communication_assessment'] ?? null,
            'occupational_therapy_assessment' => $data['occupational_therapy_assessment'] ?? null,

            'hoisting' => $data['hoisting'] ?? false,
            'assisted_devices' => $data['assisted_devices'] ?? false,
            'mobility_other' => $data['mobility_other'] ?? null,

            'hospital_bed' => $data['hospital_bed'] ?? false,
            'pressure_mattresses' => $data['pressure_mattresses'] ?? false,
            'equipment_other' => $data['equipment_other'] ?? null,

            'challenging_behaviours' => $data['challenging_behaviours'] ?? null,
            'pbsp_attached' => $data['pbsp_attached'] ?? null,
            'pbsp_required' => $data['pbsp_required'] ?? null,
            'pbsp_review_requested' => $data['pbsp_review_requested'] ?? null,
            'behaviour_support_practitioner_contact' => $data['behaviour_support_practitioner_contact'] ?? null,
        ]);
    }
}
