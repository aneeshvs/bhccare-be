<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanVision extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_visions';

    protected $fillable = [
        'support_plan_id',
        'wears_glasses_or_contacts',
        'glasses_or_contacts_type',
        'when_worn',
        'last_optometrist_appointment',
        'vision_worry',
        'vision_worry_details',
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
            ->useLogName('support_plan_vision');
    }
}
