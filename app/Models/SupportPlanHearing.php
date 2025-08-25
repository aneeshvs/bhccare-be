<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanHearing extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_hearings';

    protected $fillable = [
        'support_plan_id',
        'wears_hearing_devices',
        'hearing_devices_details',
        'when_worn',
        'last_audiologist_appointment',
        'hearing_worry',
        'hearing_worry_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_plan_hearing');
    }
}
