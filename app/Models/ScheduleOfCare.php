<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;

class ScheduleOfCare extends DefaultDBModel
{
    protected $fillable = [
        'initial_enquiry_id',
        'type_of_service',
        'primary_task_list',
        'secondary_task_list'
    ];
}
