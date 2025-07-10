<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class FundingDetail extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'type_of_funding',
        'funding_contact_person',
        'ndis_plan_attached',
        'ndis_plan_start_date',
        'ndis_plan_end_date',
        'plan_manager_name',
        'plan_manager_email',
        'plan_manager_phone'
    ];
    public function initialEnquiry()
{
    return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
}

}
