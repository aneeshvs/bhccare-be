<?php

namespace App\OnboardingService;

use App\Models\NdisGoals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NdisGoalServices
{
    public function saveMany(array $goals, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($goals as $goal) {
            if (empty($goal['goal_description'])) {
                continue;
            }

            // Try to fetch existing goal by ID (if editing), else use first match
            $record = !empty($goal['id'])
                ? NdisGoals::find($goal['id'])
                : NdisGoals::where('initial_enquiry_id', $initialEnquiryId)
                    ->where('goal_description', $goal['goal_description'])
                    ->first();

            $record = $record ?: new NdisGoals();

            // Capture old values BEFORE fill
            $original = $record->exists ? $record->getOriginal() : [];

            // Update values
            $record->fill($goal);
            $record->initial_enquiry_id = $initialEnquiryId;

            // Check if changes occurred
            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                // ✅ Log to Laravel log file for debug
                Log::info("NdisGoals: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => optional($record->initialEnquiry)->uuid,
                ]);

                // ✅ Spatie activity log
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
                $record->save(); // save silently if no changes
            }

            $saved[] = $record;
        }

        return $saved;
    }
}
