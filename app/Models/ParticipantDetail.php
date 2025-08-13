<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ParticipantDetail extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'first_name',
        'surname',
        'preferred_name',
        'date_of_birth',
        'country_of_birth',
        'identify_as_aboriginal_or_torres_strait',
        'gender',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('participant_details');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "ParticipantDetail record has been {$eventName}";
    }
}
