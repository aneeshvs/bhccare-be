<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class NdisGoals extends DefaultDBModel
{
    protected $table = 'ndis_goals_onboarding';

    protected $fillable = [
        'initial_enquiry_id',
        'goal_description',
    ];
        public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}

