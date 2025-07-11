<?php

// app/Models/MedicalAlert.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class MedicalAlert extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'has_epilepsy',
        'has_asthma',
        'has_diabetes',
        'allergies',
        'medical_info',
        'diagnosis',
        'other_description',
        'medication_taken',
        'medication_purpose',
        'staff_administer_medication',
        'medication_administered_by',
    ];

    protected $casts = [
        'has_epilepsy' => 'boolean',
        'has_asthma' => 'boolean',
        'has_diabetes' => 'boolean',
        'staff_administer_medication' => 'boolean',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}
