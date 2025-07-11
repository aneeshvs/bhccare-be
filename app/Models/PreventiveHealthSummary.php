<?php

// app/Models/PreventiveHealthSummary.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class PreventiveHealthSummary extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'medical_checkup_status',
        'last_dental_check',
        'last_hearing_check',
        'last_vision_check',
        'requires_vaccination_assistance',
    ];

    protected $casts = [
        'requires_vaccination_assistance' => 'boolean',

    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}
