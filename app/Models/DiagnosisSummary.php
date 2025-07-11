<?php

// app/Models/DiagnosisSummary.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class DiagnosisSummary extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'primary_diagnosis',
        'secondary_diagnosis',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}
