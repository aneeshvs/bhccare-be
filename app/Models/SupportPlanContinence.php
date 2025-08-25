<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanContinence extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_continences';

    protected $fillable = [
        'support_plan_id',
        'identified_needs',
        'identified_needs_details',
        'identify_toilet_needs',
        'identify_toilet_needs_details',
        'require_prompting',
        'require_prompting_details',
        'wears_continence_aids',
        'continence_aids_details',
        'ruis_required',
        'ruis_details',
        'rfis_required',
        'rfis_details',
        'funding_for_products',
        'funding_for_products_details',
        'nurse_assessment',
        'nurse_assessment_details',
        'worry_about_continence',
        'worry_about_continence_details',
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
            ->useLogName('support_plan_continence');
    }
}
