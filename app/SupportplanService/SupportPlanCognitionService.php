<?php

namespace App\SupportplanService;

use App\Models\SupportPlanCognition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanCognitionService
{
    public function save(array $data): SupportPlanCognition
    {
        $cognition = SupportPlanCognition::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $cognition->fill($data);

        if ($cognition->isDirty()) {
            $changes = $cognition->getDirty();
            $original = array_intersect_key($cognition->getOriginal(), $changes);

            Log::info('SupportPlanCognition Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $cognition->save();

            activity()
                ->useLog('support_plan_cognition')
                ->performedOn($cognition)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $cognition->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanCognition record updated');
        } else {
            $cognition->save();
        }

        return $cognition;
    }
}
