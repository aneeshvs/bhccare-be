<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportCarePlanCommunicationPlan extends DefaultDBModel
{
    use LogsActivity;
            protected $table  = 'communication_plans';

   protected $table = 'communication_plans';

    protected $fillable = [
        'support_care_plan_id',
        'helps_me_talk',
        'helps_me_understand',
        'please_communicate_by',
        'emergency_communication',
    ];

    protected $casts = [
        'helps_me_talk'          => 'array',
        'helps_me_understand'    => 'array',
        'please_communicate_by'  => 'array',
    ];

    public function supportCarePlan()
    {
        return $this->belongsTo(SupportCarePlan::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_care_plan_communication');
    }
}
