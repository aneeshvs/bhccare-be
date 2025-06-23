<?php

namespace App\Models\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use phpseclib3\Math\PrimeField\Integer;

trait TUseUUID
{

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model){
            if(!isset($model->uuid))
            {
                $model->uuid = Str::uuid();
            }

        });

    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    static public function uuidsTo(array $uuids, string $column = 'id'): array|collection
    {
        return(static::whereIn('uuid',$uuids))->get([$column])->pluck($column);
    }

    static public function uuidTo(string $uuid, string $column = 'id'):integer|string|null
    {
        if (($result=(static::where('uuid',$uuid))->first($column)))
        {
            return $result->$column;
        }
        return NULL;

    }

    static public function idsTo(array $ids, string $column ='uuid'):array|Collection
    {
        return (static::whereIn('id',$ids))->get([$column])->pluck($coloumn);
    }

    static public function idTo(array $id, string $column ='uuid'):integer|string|null
    {
        if(($result = (static::where('id',$id))->first($column)))
        {
            return $result->$column;

        }
        return NULL;

    }

}
