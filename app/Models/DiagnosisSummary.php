<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DiagnosisSummary extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'primary_diagnosis',
        'secondary_diagnosis',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Spatie Activity Log Config
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('diagnosis_summary');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "DiagnosisSummary record has been {$eventName}";
    }
}
