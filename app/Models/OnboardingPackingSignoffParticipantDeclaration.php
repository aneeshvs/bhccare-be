<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Classes\DefaultDBModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OnboardingPackingSignoffParticipantDeclaration extends DefaultDBModel
{
    use HasFactory, LogsActivity;

        protected $table = 'participant_declarations';

    protected $fillable = [
        'onboarding_packing_signoff_id',
        'participant_name',
        'relationship_to_participant',
        'participant_signature',
        'signed_date',
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('onboarding_packing_signoff_participant_declaration')
            ->logAll()
            ->logOnlyDirty();
    }

    // 🔗 Relationship back to parent
    public function onboardingPackingSignoff()
    {
        return $this->belongsTo(OnboardingPackingSignoff::class);
    }
}
