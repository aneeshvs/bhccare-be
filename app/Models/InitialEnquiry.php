<?php
// app/Models/InitialEnquiry.php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class InitialEnquiry extends DefaultDBModel
{
    protected $fillable = [
        'full_name',
        'preferred_name',
        'gender',
        'date_of_birth',
        'address',
        'postcode',
        'phone_number',
        'mobile_number',
        'email',
        'need_support_person',
        'support_person_details'
    ];
    public function funding()
{
    return $this->hasOne(FundingDetail::class, 'initial_enquiry_id');
}

}
