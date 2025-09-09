<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class FinalDeclaration extends DefaultDBModel
{
    protected $fillable = [
        'client_id',
        'primary_email',
        'secondary_email',
        'referrer_date',
        'referrer_name',
        'referrer_signature',
        'referrer_organisation',
        'client_date',
        'client_name',
        'client_signature',
        'guardian_date',
        'declaration_guardian_name',
        'guardian_signature',
    ];
     public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
