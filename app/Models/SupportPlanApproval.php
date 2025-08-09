<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanApproval extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'participant_name',
        'date_of_approval',
        'signature',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'participant_name',
                'date_of_approval',
                'signature',
                'support_plan_id',
            ])
            ->useLogName('support_plan_approval');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanApproval record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
