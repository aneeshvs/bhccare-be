<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PreventiveHealthSummary extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'medical_checkup_status',
        'last_dental_check',
        'last_hearing_check',
        'last_vision_check',
        'requires_vaccination_assistance',
    ];

    protected $casts = [
        'requires_vaccination_assistance' => 'boolean',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Spatie Logging Options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('preventive_health_summary');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "PreventiveHealthSummary record has been {$eventName}";
    }
}
