<?php
namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends DefaultDBModel
{
    protected $fillable = [
        'type_of_accommodation',
        'requested_support',
        'worker_preference',
        'date_of_referral',
    ];
}
