<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class EmergencyContact extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'name',
        'relationship',
        'phone',
        'mobile',
        'work_contact',
    ];
}
