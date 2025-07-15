<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class Staff extends DefaultDBModel
{
    protected $fillable = [
        'name' ,
        'email' ,
        'phone' ,
        'username',
        'stafftype',
        'user_id'
    ];
    // app/Models/Staff.php

    public function staffType()
    {
        return $this->belongsTo(StaffTypeMaster::class, 'stafftype');
    }
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}


}
