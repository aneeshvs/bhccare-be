<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class NdisGoal extends DefaultDBModel
{
    protected $fillable = [
        'client_id',
        'goal',
        'barriers',
        'goal_key'

    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
