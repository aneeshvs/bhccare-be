<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndividualRiskAssessmentService
{
    public function save(array $data): IndividualRiskAssessment
    {
        $conditions = [

            'user_id' => $data['user_id'] ?? null,
            'client_type' => $data['client_type'] ?? null,
        ];

        $assessment = IndividualRiskAssessment::firstOrNew($conditions);
        $assessment->fill($data);

        if ($assessment->isDirty()) {
            $changes = $assessment->getDirty();
            $original = array_intersect_key($assessment->getOriginal(), $changes);

            Log::info('IndividualRiskAssessment Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('individual_risk_assessment')
                ->performedOn($assessment)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $assessment->user_id,
                    'client_type' => $assessment->client_type,
                    'uuid' => $assessment->uuid,
                    'risk_assessment_id' => $assessment->id,
                ])
                ->log('Individual Risk Assessment record has been updated');

            $assessment->save();
        }

        return $assessment;
    }
}
