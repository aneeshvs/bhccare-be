<?php
// app/Models/HousingHistory.php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class HousingHistory extends DefaultDBModel
{
    protected $fillable = [
        'most_recent_housing',
        'prior_housing',

        'mental_health_service',
        'aboriginal_service',
        'communities_and_justice',
        'family_violence',
        'correctional_service',
        'child_protection',
        'drug_alcohol_rehabilitation',
        'other_services_involved',
        'other_services_description',

        'services_background_info',
        'services_contact_details',

        'issue_mental_health',
        'issue_drug_alcohol',
        'issue_family_violence',
        'issue_police_involvement',
        'issue_child_protection',
        'issue_child_custody',
        'issue_other_description',
    ];
}
