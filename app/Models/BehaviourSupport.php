<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BehaviourSupport extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'has_support_plan',
        'plan_copy_received',
    ];

    protected $casts = [
        'has_support_plan' => 'boolean',
        'plan_copy_received' => 'boolean',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // Log all attributes
            ->logOnlyDirty() // Only log changes
            ->useLogName('behaviour_support');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "BehaviourSupport record has been {$eventName}";
    }
}
