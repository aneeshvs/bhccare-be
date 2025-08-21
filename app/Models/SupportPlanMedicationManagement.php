<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanMedicationManagement extends DefaultDBModel
{
    use LogsActivity;

    protected $fillable = [
        'support_plan_id',
        'takes_regular_medications',
        'medication_details',
        'medication_form',
        'medication_packaging',
        'medications_locked',
        'medications_locked_details',
        'specific_storage_requirements',
        'scheduled_4_or_8_medications',
        'scheduled_medications_details',
        'chemical_restraint_medications',
        'takes_more_than_prescribed',
        'takes_more_than_prescribed_details',
        'at_risk_of_missing_medication',
        'missing_medication_details',
        'able_to_explain_purpose',
        'last_medication_review_date',
        'medication_collection_delivery_details',
        'needs_support_with_medication',
        'support_with_medication_details',
        'medication_management_worries',
        'medication_management_worries_details',
        'medication_service_required',
        'support_worker_prompt',
    ];
    protected $table = 'support_plan_medication_managements';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_plan_medication_management');
    }

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
