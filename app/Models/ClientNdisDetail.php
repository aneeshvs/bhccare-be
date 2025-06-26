<?php
// app/Models/ClientNdisDetail.php

namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class ClientNdisDetail extends DefaultDBModel
{
    protected $fillable = [
         'client_id',
        'ndis_plan_approved',
        'ndis_number',
        'ndis_plan_start_date',
        'ndis_plan_end_date',
        'plan_manager_name',
        'plan_manager_contact',
        'plan_type',
        'copy_of_plan_provided',
        'reason_plan_not_provided',
        'engagement_concerns',
        'engagement_concerns_description',
    ];
}
