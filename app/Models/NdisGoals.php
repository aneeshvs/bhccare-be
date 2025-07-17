<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class NdisGoals extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'ndis_goals_onboarding';

    protected $fillable = [
        'initial_enquiry_id',
        'goal_description',
    ];

    public function initialEnquiry()
    {
        return $this->belongsTo(InitialEnquiry::class, 'initial_enquiry_id');
    }

    // ✅ Spatie logging options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('ndis_goals');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "NdisGoals record has been {$eventName}";
    }
}
