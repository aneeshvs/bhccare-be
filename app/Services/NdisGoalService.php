<?php

namespace App\Services;

use App\Models\NdisGoal;

class NdisGoalService
{
    /**
     * Save multiple NDIS goals for a given client.
     *
     * @param array $goals
     * @param int $clientId
     * @return array
     */
    public function saveMany(array $goals, int $clientId): array
    {
        $saved = [];

        foreach ($goals as $goal) {
            $saved[] = NdisGoal::create([
                'client_id' => $clientId,
                'goal'      => $goal['goal'],
                'barriers'  => $goal['barriers'] ?? null,

            ]);
        }

        return $saved;
    }
}

