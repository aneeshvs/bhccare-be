<?php

namespace App\SupportplanService;

use App\Models\SupportPlanSocialConnection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanSocialConnectionService
{
    public function save(array $data): SupportPlanSocialConnection
    {
        $record = SupportPlanSocialConnection::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $record->fill($data);

        if ($record->isDirty()) {
            $changes  = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('SupportPlanSocialConnection Changes', [
                'dirty'    => $changes,
                'original' => $original,
            ]);

            $record->save();

            activity()
                ->useLog('support_plan_social_connection')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes'      => $changes,
                    'old'             => $original,
                    'staff_id'        => $data['staff_id'] ?? null,
                    'user_id'         => $data['user_id'] ?? null,
                    'client_type'     => $data['client_type'] ?? null,
                    'uuid'            => $record->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanSocialConnection record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
