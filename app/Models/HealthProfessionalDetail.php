<?php

// app/Models/HealthProfessionalDetail.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class HealthProfessionalDetail extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'role',
        'name',
        'contact_number',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}

