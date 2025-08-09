<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlan extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [

        'user_id',
        'staff_id',
        'client_type',
        'effective_date',
        'review_date',
        'confirmation_date',
        'developed_by',
        'invited_but_not_participated',
        'form_status',
    ];

    protected $attributes = [
        'form_status' => 'in_progress',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'effective_date', 'review_date', 'confirmation_date',
                'developed_by', 'invited_but_not_participated',
                'user_id', 'client_type', 'form_status'
            ])
            ->useLogName('support_plan');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlan record has been {$eventName}";
    }
    // In App\Models\SupportPlan.php
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
        public function approval()
    {
        return $this->hasOne(SupportPlanApproval::class);
    }
        public function representativeApproval()
    {
        return $this->hasOne(SupportPlanRepresentative::class);
    }
    public function careApproval()
    {
        return $this->hasOne(SupportPlanCarePartner::class);
    }



}

