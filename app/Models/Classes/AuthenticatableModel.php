<?php
namespace App\Models\Classes;
use App\Models\classes\DefaultDBModel;
use App\Models\Traits\TBaseModel;
use App\Models\Traits\TDatabaseTableInfo;
use App\Models\Traits\TOwnerRelationship;
use App\Models\Traits\TStateRelationship;
use App\Models\Traits\TUseUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;




abstract class AuthenticatableModel extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;
    use TBaseModel, TDatabaseTableInfo, TUseUUID, TStateRelationship, TOwnerRelationship;

    public static function init(): string
    {
        // Optional override of the init method (if needed)
        return 'AuthenticatableModel Initialized';
    }

        public  function setPasswordAttribute($value):void
        {
            $this->attributes['password'] = Hash::make($value);
        }
}

