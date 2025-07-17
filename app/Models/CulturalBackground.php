<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CulturalBackground extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'initial_enquiry_id',
        'has_children_under_18',
        'country_of_birth',
        'preferred_language',
        'religion',
        'other_languages',
        'cultural_needs',
        'interpreter_required',
        'auslan_required'
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Log all changes for audit
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('cultural_background');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "CulturalBackground record has been {$eventName}";
    }
}
