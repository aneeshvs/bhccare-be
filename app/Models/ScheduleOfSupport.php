<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ScheduleOfSupport extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'schedule_of_supports';

    protected $fillable = [
        'user_id',
        'staff_id',
        'client_type',
        'participant_name',
        'creation_date',
        'funding_review_date',
        'support_on_public_holiday',
        'form_status',
        'completion_percentage',
    ];

    protected $attributes = [
        'form_status' => 'in_progress',
        'completion_percentage' => 0,
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('schedule_of_support');
    }
}
