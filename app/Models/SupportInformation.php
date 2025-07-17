<?php


namespace App\Models;

use App\Models\Classes\DefaultDBModel;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportInformation extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'communication_assistance_required',
        'mealtime_plan',
        'likes',
        'dislikes',
        'interests',
        'male',
        'female',
        'no_preference',
        'special_request',
    ];

    protected $casts = [
        'communication_assistance_required' => 'boolean',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all fillable fields
            ->logOnlyDirty()
            ->useLogName('support_information');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportInformation record was {$eventName}";
    }
}


