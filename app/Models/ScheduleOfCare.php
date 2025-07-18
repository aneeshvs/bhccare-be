<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ScheduleOfCare extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'type_of_service',
        'primary_task_list',
        'secondary_task_list',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Spatie activity log config
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // logs all fillable attributes
            ->logOnlyDirty()
            ->useLogName('schedule_of_care'); // optional: custom log name
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "ScheduleOfCare record has been {$eventName}";
    }

}
