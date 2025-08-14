<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanContactDetailSecondary extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'secondary_role',
        'secondary_phone',
        'secondary_email',
        'secondary_address',
        'secondary_best_time_to_contact',
        'secondary_is_mac_registered',
        'secondary_list_documents',
        'secondary_legal_documentation_stored',
        'secondary_date_legal_orders_end',
        'secondary_participants_agreed_contact',
        'secondary_participants_agreed_contact_date',
        'secondary_decision_making_approval_for',
    ];

    protected $table = 'support_plan_contact_details_secondary';


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly($this->fillable)
            ->useLogName('support_plan_contact_detail_secondary');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "SupportPlanContactDetailSecondary record has been {$eventName}";
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
