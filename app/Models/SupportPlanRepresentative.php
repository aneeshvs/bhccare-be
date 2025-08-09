<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanRepresentative extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'support_representative_name',
        'role',
        'date_of_approval',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'support_representative_name',
                'role',
                'date_of_approval',
                'support_plan_id',
            ])
            ->useLogName('support_plan_representative');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanRepresentative record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
