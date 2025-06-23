<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends DefaultDBModel
{
    use HasFactory;

    protected $fillable= [
        'owner_id',
        'owner_type',
        'name',
        'slug',
        'is_enabled',
    ];
}
