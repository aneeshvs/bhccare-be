<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MedicalAlert extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'epilepsy',
        'asthma',
        'diabetes',
        'allergies',
        'medical_info',
        'diagnosis',
        'other_description',
        'medication_taken',
        'medication_purpose',
        'staff_administer_medication',
        'self_administered',
        'guardian',
        'support_worker',
    ];

    protected $casts = [
        'epilepsy' => 'boolean',
        'asthma' => 'boolean',
        'diabetes' => 'boolean',
        'staff_administer_medication' => 'boolean',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Spatie Activitylog config
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('medical_alert');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "MedicalAlert record has been {$eventName}";
    }
}
