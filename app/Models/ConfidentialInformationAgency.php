<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ConfidentialInformationAgency extends DefaultDBModel
{
    use LogsActivity;

   protected $table ='confidential_agencies';

    protected $fillable = [
        'confidential_information_form_id',
        'goal_key',
        'name',
        'role',
        'contact',
        'agency_name',
        'service_type',
        'information_shared',
    ];

    public function form()
    {
        return $this->belongsTo(ConfidentialInformationForm::class, 'confidential_information_form_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('confidential_information_agency');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "ConfidentialInformationAgency record has been {$eventName}";
    }
}
