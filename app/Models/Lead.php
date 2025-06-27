<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class Lead extends DefaultDBModel
{
    protected $fillable = [
        'full_name',
        'email',
        'mobile',
        'form_status',
    ];

    // Route model binding using uuid
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
        public function client()
    {
        return $this->hasOne(Client::class);
    }
}
