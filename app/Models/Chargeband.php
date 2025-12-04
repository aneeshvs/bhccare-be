<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
