<?php

namespace App\ScheduleOfSupportService;

use App\Models\FundedSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FundedSupportService
{
    /**
     * Save multiple FundedSupport records
     *
     * @param array $supports
     * @param int $scheduleOfSupportId
     * @return array
     */
    public function saveMany(array $supports, int $scheduleOfSupportId): array
    {
        $saved = [];

        foreach ($supports as $support) {
            if (empty($support['description'] ?? null)) {
                continue;
            }

            // Auto-generate unique key per record (optional, similar to goal_key)
            if (empty($support['goal_key'])) {
                $support['goal_key'] = 'funded_' . Str::uuid();
            }

            $record = FundedSupport::firstOrNew([
                'schedule_of_support_id' => $scheduleOfSupportId,
                'goal_key' => $support['goal_key'],
            ]);

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($support);
            $record->schedule_of_support_id = $scheduleOfSupportId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("FundedSupport changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'schedule_of_support_id' => $record->schedule_of_support_id,
                ]);

                activity()
                    ->useLog('funded_support')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'schedule_of_support_id' => $record->schedule_of_support_id,
                        'user_id' => $support['user_id'] ?? null,
                        'staff_id' => $support['staff_id'] ?? Auth::id(),
                    ])
                    ->log('Funded Support record updated');
            } else {
                $record->save();
            }

            $saved[] = $record;
        }

        return $saved;
    }
}
