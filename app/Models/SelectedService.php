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
        'goal_key',
    ];
     public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
