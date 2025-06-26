<?php
// app/Models/SelectedService.php

namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class SelectedService extends DefaultDBModel
{
    protected $fillable = [
         'client_id',
        'service_name',
    ];
}
