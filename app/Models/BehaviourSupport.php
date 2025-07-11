<?php

// app/Models/BehaviourSupport.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class BehaviourSupport extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'has_support_plan',
        'plan_copy_received',
    ];

    protected $casts = [
        'has_support_plan' => 'boolean',
        'plan_copy_received' => 'boolean',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}
