<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class CulturalBackground extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'has_children_under_18',
        'country_of_birth',
        'preferred_language',
        'religion',
        'other_languages',
        'cultural_needs',
        'interpreter_required',
        'auslan_required'
    ];
    public function initialEnquiry()
{
    return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
}
}
