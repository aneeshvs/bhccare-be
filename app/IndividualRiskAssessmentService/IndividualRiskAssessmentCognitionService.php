<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessmentCognition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndividualRiskAssessmentCognitionService
{
    public function save(array $data): IndividualRiskAssessmentCognition
    {
        $cognition = IndividualRiskAssessmentCognition::firstOrNew([
            'individual_risk_assessment_id' => $data['individual_risk_assessment_id'],
        ]);

        $cognition->fill($data);

        if ($cognition->isDirty()) {
            $changes = $cognition->getDirty();
            $original = array_intersect_key($cognition->getOriginal(), $changes);

            Log::info('IndividualRiskAssessmentCognition Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('individual_risk_assessment_cognition')
                ->performedOn($cognition)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'individual_risk_assessment_id' => $cognition->individual_risk_assessment_id,
                    'uuid' => $cognition->uuid ?? null,
                ])
                ->log('Individual Risk Assessment Cognition record has been updated');

            $cognition->save();
        }

        return $cognition;
    }
}
