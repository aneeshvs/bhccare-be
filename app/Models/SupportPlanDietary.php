<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanDietary extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_dietaries';

    protected $fillable = [
        'support_plan_id',
        'intolerances',
        'intolerances_details',
        'dysphagia_concerns',
        'dysphagia_details',
        'speech_pathologist_recommendations',
        'iddsi_food_category',
        'iddsi_liquid_category',
        'prepares_meals',
        'prepares_meals_details',
        'needs_meal_support',
        'meal_support_details',
        'diet_meets_needs',
        'diet_meets_needs_details',
        'needs_cutting_support',
        'cutting_support_details',
        'needs_feeding_support',
        'feeding_support_details',
        'dietician_referral_required',
        'dietician_referral_details',
        'needs_shopping_support',
        'shopping_support_details',
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
            ->useLogName('support_plan_dietary');
    }
}
