<?php
// app/Models/StaffTypeMaster.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class StaffTypeMaster extends DefaultDBModel
{
    protected $table = 'staff_type_master';

    protected $fillable = ['name'];
}
