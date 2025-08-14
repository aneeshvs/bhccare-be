<?php

namespace App\SupportplanService;

use App\Models\SupportPlanContactDetailSecondary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanContactDetailSecondaryService
{
    public function save(array $data): SupportPlanContactDetailSecondary
    {
        $contactDetailSecondary = SupportPlanContactDetailSecondary::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $contactDetailSecondary->fill($data);

        if ($contactDetailSecondary->isDirty()) {
            $changes = $contactDetailSecondary->getDirty();
            $original = array_intersect_key($contactDetailSecondary->getOriginal(), $changes);

            Log::info('SupportPlanContactDetailSecondary Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $contactDetailSecondary->save();

            activity()
                ->useLog('support_plan_contact_detail_secondary')
                ->performedOn($contactDetailSecondary)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $contactDetailSecondary->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanContactDetailSecondary record has been updated');
        }

        return $contactDetailSecondary;
    }
}
