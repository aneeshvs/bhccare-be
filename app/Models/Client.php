<?php
namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class Client extends DefaultDBModel
{
    protected $fillable = [
        'lead_id',
        'full_name',
        'date_of_birth',
        'gender',
        'residential_address',
        'mobile',
        'email',
        'atsi_status',
        'cultural_background',
        'language_spoken',
        'interpreter_required',
        'guardian_name',
        'is_public_guardian',
        'guardian_relationship',
        'guardian_mobile',
        'guardian_email',
        'guardian_address',
        'guardian_contact_method',
    ];

    protected $casts = [
        'interpreter_required' => 'boolean',

        'date_of_birth' => 'date',
    ];
        public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
