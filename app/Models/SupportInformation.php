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

    // optional: for clarity
    protected static $logName = 'support_information';
    protected static $logFillable = true; // or define $logAttributes

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable) // or ->logFillable()
            ->logOnlyDirty()
            ->useLogName(self::$logName);
    }

    public function getMaleAttribute($value)
    {
        return $value == 1 ? 'checked' : 'unchecked';
    }

    public function getFemaleAttribute($value)
    {
        return $value == 1 ? 'checked' : 'unchecked';
    }

    public function getNoPreferenceAttribute($value)
    {
        return $value == 1 ? 'checked' : 'unchecked';
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportInformation record was {$eventName}";
    }
}
