<?php

namespace App\SupportplanService;

use App\Models\CulturalDiversity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CulturalDiversityService
{
    public function save(array $data): CulturalDiversity
    {
        $cultural = CulturalDiversity::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $cultural->fill($data);

        if ($cultural->isDirty()) {
            $changes = $cultural->getDirty();
            $original = array_intersect_key($cultural->getOriginal(), $changes);

            Log::info('CulturalDiversity Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $cultural->save();

            activity()
                ->useLog('cultural_diversity')
                ->performedOn($cultural)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $cultural->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('CulturalDiversity record has been updated');
        } else {
            $cultural->save();
        }

        return $cultural;
    }
}
