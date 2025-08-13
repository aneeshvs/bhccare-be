<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class KeepingInTouch extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'need_help_to_communicate',
        'type_of_difficulty',
        'contact_first_instance',
        'details',
        'language_spoken',
        'use_nrs',
        'require_interpreter',
        'written',
        'verbal',
        'schedule_change_notification',
        'interpreter_arrangement',
        'financial_statement_method',
        'feedback_survey_method',
        'marketing_material_method',
        'preferred_communication_method',
        'join_cab',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('keeping_in_touch');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "KeepingInTouch record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
