<?php

namespace App\OnboardingPackingSignoffService;

use App\Models\OnboardingPackingSignoff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OnboardingPackingSignoffService
{
    public function save(array $data): OnboardingPackingSignoff
    {
        $record = OnboardingPackingSignoff::firstOrNew([
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ]);

        $isNew = !$record->exists;
        $record->fill($data);

        $changes = $record->getDirty();
        $original = $isNew ? [] : array_intersect_key($record->getOriginal(), $changes);
        $record->save();

        if ($isNew || !empty($changes)) {
            activity()
                ->useLog('onboarding_packing_signoff')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $record->user_id,
                    'client_type' => $record->client_type,
                    'uuid' => $record->uuid,
                    'onboarding_packing_signoff_id' => $record->id,
                ])
                ->log($isNew ? 'Onboarding Packing Sign Off created' : 'Onboarding Packing Sign Off updated');

            Log::info('OnboardingPackingSignoff Log:', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $original,
            ]);
        }

        return $record;
    }
}
