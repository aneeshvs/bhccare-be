<?php

// app/Models/HealthInformation.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class HealthInformation extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'health_conditions',
    ];

    protected $casts = [
        'health_conditions' => 'array',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}
