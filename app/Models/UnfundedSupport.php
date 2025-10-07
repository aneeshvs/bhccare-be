<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UnfundedSupport extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'schedule_of_support_id',
        'support_name',
        'description',
        'price_information',
        'delivery_details',
        'price',
        'grand_total',
    ];

    public function scheduleOfSupport()
    {
        return $this->belongsTo(ScheduleOfSupport::class, 'schedule_of_support_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('unfunded_support');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "UnfundedSupport record has been {$eventName}";
    }
}
