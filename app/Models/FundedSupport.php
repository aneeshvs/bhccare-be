<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FundedSupport extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'schedule_of_support_id',
        'support_name',
        'goal_key',
        'description',
        'price',
        'unit',
        'payment_information',
        'invoicing_details',
        'delivery_details',
        'grand_total',
    ];

    public function scheduleOfSupport()
    {
        return $this->belongsTo(ScheduleOfSupport::class, 'schedule_of_support_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()           // log all attributes
            ->logOnlyDirty()     // log only when attributes change
            ->useLogName('funded_support');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "FundedSupport record has been {$eventName}";
    }
}
