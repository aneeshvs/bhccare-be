<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SupportPlanMobilityTransfer extends DefaultDBModel
{
    use LogsActivity;



    protected $fillable = [
        'support_plan_id',
        'can_walk_independently',
        'walk_independently_details',
        'needs_transfer_support',
        'primary_equipment_used',
        'can_climb_stairs',
        'climb_stairs_details',
        'has_stairs_at_home',
        'stairs_at_home_details',
        'can_transfer_self',
        'can_transfer_in_other_envs',
        'uses_bed_pole_or_rails',
        'bed_pole_prescribed_by_ot',
        'can_access_places_outside_walking_distance',
        'access_places_details',
        'safe_to_mobilise_in_yard',
        'mobilise_yard_details',
        'community_access',
        'drives',
        'medications_or_conditions_risk',
        'driving_risk_details',
        'mobility_equipment',
        'equipment_purchase_type',
        'uses_four_wheel_walker',
        'four_wheel_walker_details',
        'wheelchair_type',
        'wheelchair_operation',
        'wheelchair_ot_recommended',
        'can_charge_wheelchair',
        'last_wheelchair_service_date',
        'can_carry_5kg',
        'carry_5kg_details',
        'foot_problems',
        'foot_problems_details',
        'mobility_worries',
        'mobility_worries_details',
        'last_ot_assessment_date',
        'new_ot_referral_required',
        'demmi_assessment_required',
        'demmi_assessment_result',
    ];
    protected $table = 'support_plan_mobility_transfers';

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('support_plan_mobility_transfer');
    }
}
