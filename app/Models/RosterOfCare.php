<?php
namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;


class RosterOfCare extends DefaultDBModel
{
    protected $table = 'roster_of_care';

    protected $fillable = [
        'need_bhc_community_support',
        'comments',
        'transport_funding',
    ];
}
