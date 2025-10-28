<?php

namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OnboardingPackingSignoffDisabilityActDiscussion extends DefaultDBModel
{
    use LogsActivity;

    protected $table = 'disability_act_discussions';

    protected $fillable = [
        'onboarding_packing_signoff_id',
        'clarify_services_provided',
        'verbal_information_intake_process',
        'cost_of_services',
        'participant_rights_handbook',
    ];

    public function onboardingPackingSignoff()
    {
        return $this->belongsTo(OnboardingPackingSignoff::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logFillable()
            ->useLogName('onboarding_packing_signoff_disability_act_discussion');
    }
}
