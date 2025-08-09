<?php

namespace App\SupportplanService;

use App\Models\SupportPlanApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanApprovalService
{
    public function save(array $data): SupportPlanApproval
    {
        $approval = SupportPlanApproval::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $approval->fill($data);

        if ($approval->isDirty()) {
            $changes = $approval->getDirty();
            $original = array_intersect_key($approval->getOriginal(), $changes);

            Log::info('SupportPlanApproval Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('support_plan_approval')
                ->performedOn($approval)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanApproval record has been updated');

            $approval->save();
        }

        return $approval;
    }
}
