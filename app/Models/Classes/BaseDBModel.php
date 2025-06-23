<?php
namespace App\Models\Classes;

use App\Models\Traits\{TBaseModel,TDatabaseTableInfo, TUseUUID};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseDBModel extends Model
{
    const REL_TYPE_BELONGS_TO_MANY = 2;

    use SoftDeletes;
    use TBaseModel, TDatabaseTableInfo,TUseUUID;
}
