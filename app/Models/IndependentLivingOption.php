<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class IndependentLivingOption extends DefaultDBModel
{
    protected $fillable = [
        'client_id',
        'rent_per_week',
        'utilities_per_week',
        'needs_furnished',
        'owns_furniture',
        'lease_duration',
        'can_pay_bond_upfront',
        'preferred_location',
        'living_preference',
    ];
     public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
