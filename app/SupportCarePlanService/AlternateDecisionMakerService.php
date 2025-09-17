<?php

namespace App\SupportCarePlanService;

use App\Models\AlternateDecisionMaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AlternateDecisionMakerService
{
    public function save(array $data): AlternateDecisionMaker
    {
        $conditions = [
            'support_care_plan_id' => $data['support_care_plan_id'],
        ];

        $adm = AlternateDecisionMaker::firstOrNew($conditions);
        $adm->fill($data);

        if ($adm->isDirty()) {
            $changes = $adm->getDirty();
            $original = array_intersect_key($adm->getOriginal(), $changes);

            Log::info('AlternateDecisionMaker Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('alternate_decision_maker')
                ->performedOn($adm)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'support_care_plan_id' => $adm->support_care_plan_id,
                    'user_id' => $data['user_id'] ?? null,
                ])
                ->log('Alternate Decision Maker record has been updated');

            $adm->save();
        }

        return $adm;
    }
}
