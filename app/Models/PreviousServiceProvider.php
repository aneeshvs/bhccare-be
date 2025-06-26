<?php
// app/Models/PreviousServiceProvider.php

namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class PreviousServiceProvider extends DefaultDBModel
{
    protected $fillable = [
         'client_id',
        'provider',
        'contact_details',
        'length_of_support',
        'reason_for_leaving',
    ];
}
