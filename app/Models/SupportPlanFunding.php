<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanFunding extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'aged_care_id',
        'pension_status',
        'pension_card_details',
        'card_number',
        'card_expiry',
        'approved_funding_level',
        'awaiting_package_upgrade',
        'upgrade_details',
        'has_chsp_referral_codes',
        'chsp_referral_details',
        'war_veteran_or_widow',
        'dva_number',
        'medicare_number',
        'private_health_insurance',
        'hcp_funding_level',
        'has_companion_card',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('support_plan_funding');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanFunding record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
