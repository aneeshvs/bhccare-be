<?php

namespace App\SupportplanService;

use App\Models\SupportPlanMobilityTransfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanMobilityTransferService
{
    public function save(array $data): SupportPlanMobilityTransfer
    {
        $record = SupportPlanMobilityTransfer::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('SupportPlanMobilityTransfer Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $record->save();

            activity()
                ->useLog('support_plan_mobility_transfer')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $record->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanMobilityTransfer record has been updated');
        }

        return $record;
    }
}
