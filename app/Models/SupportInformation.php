<?php


namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class SupportInformation extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'communication_assistance_required',
        'mealtime_plan',
        'likes',
        'dislikes',
        'interests',
         'Male',
         'Female',
         'No Preference',

        'special_request',
    ];

    protected $casts = [
        'communication_assistance_required' => 'boolean',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }
}
