<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Chargeband extends Model
{
    protected $table = 'chargeband';

    public $timestamps = false; // since table uses created_date manually

    protected $fillable = [
        'chargeband_name',
        'categoryid',
        'fundtypeid',
        'serviceid',
        'color',
        'status',
        'created_date',
        'companyid',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
