<?php
namespace App\Services;

use App\Models\NdisGoal;
use Illuminate\Support\Str;

class NdisGoalService
{
    public function saveMany(array $goals, int $clientId): array
    {
        $saved = [];

        foreach ($goals as $row) {

            $goalName = trim($row['goal'] ?? '');

            // Skip empty goals
            if ($goalName === '') {
                continue;
            }

            // Auto-generate goal_key if missing
            if (empty($row['goal_key'])) {
                $row['goal_key'] = 'ndis_goal_' . Str::uuid();
            }

            // Find existing goal by client + goal_key
            $goal = NdisGoal::firstOrNew([
                'client_id' => $clientId,
                'goal_key'  => $row['goal_key'],
            ]);

            // Fill fields
            $goal->goal     = $goalName;
            $goal->barriers = $row['barriers'] ?? null;

            // Save (no logging)
            $goal->save();

            $saved[] = $goal;
        }

        return $saved;
    }
}
