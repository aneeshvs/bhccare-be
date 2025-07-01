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

            // Skip empty goal names
            if ($goalName === '') {
                continue;
            }

            $goalId = $goal['id'] ?? null;
            $barriers = $goal['barriers'] ?? null;

            // 1. Try to update by goal ID if available
            if ($goalId) {
                $existing = NdisGoal::where('id', $goalId)
                    ->where('client_id', $clientId)
                    ->first();

                if ($existing) {
                    $existing->update([
                        'goal'     => $goalName,
                        'barriers' => $barriers,
                    ]);
                    $saved[] = $existing;
                    continue;
                }
            }

            // 2. Fallback: Try to match by goal name (case-insensitive)
            $existing = NdisGoal::where('client_id', $clientId)
                ->whereRaw('LOWER(goal) = ?', [strtolower($goalName)])
                ->first();

            if ($existing) {
                $existing->update([
                    'barriers' => $barriers,
                ]);
                $saved[] = $existing;
                continue;
            }

            // 3. Insert new goal if nothing matches
            $saved[] = NdisGoal::create([
                'client_id' => $clientId,
                'goal'      => $goalName,
                'barriers'  => $barriers,
            ]);
        }

        return $saved;
    }
}
