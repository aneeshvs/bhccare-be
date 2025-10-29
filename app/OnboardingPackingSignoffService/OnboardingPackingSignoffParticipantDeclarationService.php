<?php

namespace App\OnboardingPackingSignoffService;

use App\Models\OnboardingPackingSignoffParticipantDeclaration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OnboardingPackingSignoffParticipantDeclarationService
{
    public function save(array $data): OnboardingPackingSignoffParticipantDeclaration
    {
        $declaration = OnboardingPackingSignoffParticipantDeclaration::firstOrNew([
            'onboarding_packing_signoff_id' => $data['onboarding_packing_signoff_id'],
        ]);

        // 🖋 If file uploaded, convert to binary
        if (isset($data['participant_signature']) && $data['participant_signature'] instanceof \Illuminate\Http\UploadedFile) {
            $data['participant_signature'] = file_get_contents($data['participant_signature']->getRealPath());
        }

        $declaration->fill($data);

        if ($declaration->isDirty()) {
            $changes = $declaration->getDirty();
            $original = array_intersect_key($declaration->getOriginal(), $changes);

            Log::info('Onboarding Packing Signoff Participant Declaration Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('onboarding_packing_signoff_participant_declaration')
                ->performedOn($declaration)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'user_id' => $data['user_id'] ?? null,
                    'staff_id' => $data['staff_id'] ?? null,
                    'onboarding_packing_signoff_id' => $declaration->onboarding_packing_signoff_id,
                ])
                ->log('Participant Declaration record updated');
        }

        $declaration->save();

        return $declaration;
    }
}
