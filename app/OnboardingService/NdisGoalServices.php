<?php

namespace App\OnboardingService;

use App\Models\NdisGoals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NdisGoalServices
{

public function saveMany(array $goals, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($goals as $goal) {
            if (empty($goal['goal_description'])) {
                continue;
            }

            // 🛠️ Auto-generate goal_key if missing
            if (empty($goal['goal_key'])) {
                $goal['goal_key'] = 'goal_' . Str::uuid();
            }

            $record = NdisGoals::firstOrNew([
                'initial_enquiry_id' => $initialEnquiryId,
                'goal_key' => $goal['goal_key'],
            ]);

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($goal);
            $record->initial_enquiry_id = $initialEnquiryId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("NdisGoals: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => optional($record->initialEnquiry)->uuid,
                ]);

                activity()
                    ->useLog('ndis_goals')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'initial_enquiry_id' => $record->initial_enquiry_id,
                        'uuid' => $goal['uuid'] ?? optional($record->initialEnquiry)->uuid,
                        'user_id' => $goal['user_id'] ?? optional($record->initialEnquiry)->user_id,
                        'client_type' => $goal['client_type'] ?? optional($record->initialEnquiry)->client_type,
                        'staff_id' => $goal['staff_id'] ?? optional($record->initialEnquiry)->staff_id,
                    ])
                    ->log('NdisGoal record has been updated');
            } else {
                $record->save();
            }

            $saved[] = $record;
        }

        return $saved;
    }
}


