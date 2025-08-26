<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanSocialConnection extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'support_plan_social_connections';

    protected $fillable = [
        'support_plan_id',
        'feels_lonely',
        'feels_lonely_details',
        'has_informal_supports',
        'informal_supports_details',
        'wants_more_community_engagement',
        'community_engagement_details',
        'wants_support_for_community_engagement',
        'support_for_community_engagement_details',
        'needs_community_access_support',
        'community_access_support_details',
        'has_taxi_card',
        'taxi_card_details',
        'interested_in_visitors_program',
        'visitors_program_details',
        'has_hobbies_activities',
        'hobbies_activities_details',
        'needs_duke_index',
        'duke_index_details',
        'social_connections_needs_feeding_support',
        'social_connections_feeding_support_details',
        'social_connections_wants_dietician_referral',
        'social_connections_dietician_referral_details',
        'social_connections_needs_shopping_support',
        'social_connections_shopping_support_details',
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
            ->useLogName('support_plan_social_connection');
    }
}
