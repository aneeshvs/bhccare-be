<?php
namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class Referral extends DefaultDBModel
{
    protected $fillable = [
        'client_id',
        'agency',
        'contact_name',
        'job_title',
        'work_contact',
        'referral_mobile',
        'email',
        'has_consent',
    ];

    protected $casts = [
        'has_consent' => 'boolean',
    ];
     public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
