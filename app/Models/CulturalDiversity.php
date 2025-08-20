<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CulturalDiversity extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'is_lgbti',
        'lgbti_details',
        'is_separated_family',
        'separated_family_details',
        'has_cultural_events',
        'cultural_events_details',
        'has_past_events',
        'past_events_details',
        'has_non_disclosure_items',
        'non_disclosure_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('cultural_diversity');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "CulturalDiversity record has been {$eventName}";
    }
}
