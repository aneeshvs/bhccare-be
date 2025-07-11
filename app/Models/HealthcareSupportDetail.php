<?php

// app/Models/HealthcareSupportDetail.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class HealthcareSupportDetail extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'medicare',
        'health_fund',
        'pension_card_number',
        'health_care_card',
        'dva_type',
        'dva_number',
        'companion_card',
        'preferred_hospital',
        'ambulance_number',
        'disabled_parking',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}

