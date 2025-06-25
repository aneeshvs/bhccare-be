<?php
namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class Referral extends DefaultDBModel
{
    protected $fillable = [
        'agency',
        'contact_name',
        'job_title',
        'work_contact',
        'mobile',
        'email',
        'has_consent',
    ];

    protected $casts = [
        'has_consent' => 'boolean',
    ];
}
