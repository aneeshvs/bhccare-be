<?php

namespace App\Models\Traits;

use App\Models\MasterData\State;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait TStateRelationship
{
    public function state(): HasOne
    {
        return $this->hasOne(State::class,'id','state_id');
    }
}