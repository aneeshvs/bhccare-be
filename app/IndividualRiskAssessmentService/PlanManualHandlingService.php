<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\PlanManualHandling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PlanManualHandlingService
{
    public function saveMany(array $records, int $supportCarePlanId): array
    {
        $saved = [];
        $processedIds = [];

        foreach ($records as $recordData) {
            // Skip if all empty
            if (empty($recordData['training_provided']) && empty($recordData['tasks_safe'])) {
                continue;
            }

            if (empty($recordData['goal_key'])) {
                $recordData['goal_key'] = 'goal_' . Str::uuid();
            }

            $record = null;

            // 1. Update by ID
            if (!empty($recordData['id'])) {
                $record = PlanManualHandling::where('id', $recordData['id'])
                    ->where('individual_risk_assessment_id', $supportCarePlanId)
                    ->first();
            }

            // 2. Update by goal_key
            if (!$record && !empty($recordData['goal_key'])) {
                $record = PlanManualHandling::where('individual_risk_assessment_id', $supportCarePlanId)
                    ->where('goal_key', $recordData['goal_key'])
                    ->first();
            }

            // 3. Create new
            if (!$record) {
                $record = new PlanManualHandling();
                $record->individual_risk_assessment_id = $supportCarePlanId;
                $record->goal_key = $recordData['goal_key'];
            }

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($recordData);
            $record->individual_risk_assessment_id = $supportCarePlanId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("ManualHandling: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => optional($record->supportCarePlan)->uuid,
                ]);

                activity()
                    ->useLog('plan_manual_handlings')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'individual_risk_assessment_id' => $record->individual_risk_assessment_id,
                        'uuid' => $recordData['uuid'] ?? optional($record->supportCarePlan)->uuid,
                        'user_id' => $recordData['user_id'] ?? optional($record->supportCarePlan)->user_id,
                        'client_type' => $recordData['client_type'] ?? optional($record->supportCarePlan)->client_type,
                        'staff_id' => $recordData['staff_id'] ?? optional($record->supportCarePlan)->staff_id,

                    ])
                    ->log('Manual Handling record updated');
            } else {
                $record->save();
            }

            $saved[] = $record;
            $processedIds[] = $record->id;
        }

        return $saved;
    }
}
