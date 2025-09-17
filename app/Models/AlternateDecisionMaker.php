<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AlternateDecisionMaker extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_care_plan_id',
        'type',
        'first_name',
        'surname',
        'notes',
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
            ->useLogName('alternate_decision_maker');
    }
}
