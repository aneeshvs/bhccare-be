<?php
namespace App\Services;

use App\Models\NdisGoal;

class NdisGoalService
{
    public function saveMany(array $goals, int $clientId): array
    {
        $saved = [];

        foreach ($goals as $goal) {
            $goalName = trim($goal['goal'] ?? '');
;
            // Skip empty goal names
            if ($goalName === '') {
                continue;
            }



            // Find existing goal for client (case-insensitive match)
            $existing = NdisGoal::where('client_id', $clientId)
                ->whereRaw('LOWER(goal) = ?', [strtolower($goalName)])
                ->first();

            if ($existing) {
                // Update only if barrier value changed
                $existing->update([
                    'barriers' => $goal['barriers'] ?? null,
                ]);
                $saved[] = $existing;
            } else {
                // Create new
                $saved[] = NdisGoal::create([
                    'client_id' => $clientId,
                    'goal'      => $goalName,
                    'barriers'  => $goal['barriers'] ?? null,
                ]);
            }
        }

        return $saved;
    }
}
