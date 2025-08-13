<?php

namespace App\SupportplanService;

use App\Models\KeepingInTouch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KeepingInTouchService
{
    public function save(array $data): KeepingInTouch
    {
        $record = KeepingInTouch::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('KeepingInTouch Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $record->save();

            activity()
                ->useLog('keeping_in_touch')
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
                ->log('KeepingInTouch record has been updated');
        }

        return $record;
    }
}
