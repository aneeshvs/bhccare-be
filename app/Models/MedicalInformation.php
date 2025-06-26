<?php
// app/Models/MedicalInformation.php

namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class MedicalInformation extends DefaultDBModel
{
    protected $fillable = [
         'client_id',
        'primary_disability',
        'secondary_disability',
        'requires_high_intensity_support',

        'complex_bowel_care',
        'enteral_feeding',
        'tracheostomy_care',
        'urinary_catheters',
        'ventilation',
        'subcutaneous_injection',

        'communication_method',
        'communication_assessment',
        'occupational_therapy_assessment',

        'hoisting',
        'assisted_devices',
        'mobility_other',

        'hospital_bed',
        'pressure_mattresses',
        'equipment_other',

        'challenging_behaviours',
        'pbsp_attached',
        'pbsp_required',
        'pbsp_review_requested',
        'behaviour_support_practitioner_contact',
    ];
}
