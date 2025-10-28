<?php

namespace App\OnboardingPackingSignoffService;

use App\Models\OnboardingPackingSignoffDisabilityActDiscussion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OnboardingPackingSignoffDisabilityActDiscussionService
{
    public function save(array $data): OnboardingPackingSignoffDisabilityActDiscussion
    {
        $discussion = OnboardingPackingSignoffDisabilityActDiscussion::firstOrNew([
            'onboarding_packing_signoff_id' => $data['onboarding_packing_signoff_id'],
        ]);

        $discussion->fill($data);

        if ($discussion->isDirty()) {
            $changes = $discussion->getDirty();
            $original = array_intersect_key($discussion->getOriginal(), $changes);

            Log::info('Onboarding Packing Signoff Disability Act Discussion Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('onboarding_packing_signoff_disability_act_discussion')
                ->performedOn($discussion)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'user_id' => $data['user_id'] ?? null,
                    'staff_id' => $data['staff_id'] ?? null,
                    'onboarding_packing_signoff_id' => $discussion->onboarding_packing_signoff_id,
                ])
                ->log('Disability Act Discussion record updated');
        }

        $discussion->save();

        return $discussion;
    }
}
