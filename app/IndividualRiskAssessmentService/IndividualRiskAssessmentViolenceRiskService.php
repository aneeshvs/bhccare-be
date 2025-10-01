<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessmentViolenceRisk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndividualRiskAssessmentViolenceRiskService
{
    public function save(array $data): IndividualRiskAssessmentViolenceRisk
    {
        $risk = IndividualRiskAssessmentViolenceRisk::firstOrNew([
            'individual_risk_assessment_id' => $data['individual_risk_assessment_id'],
        ]);

        $risk->fill($data);

        if ($risk->isDirty()) {
            $changes = $risk->getDirty();
            $original = array_intersect_key($risk->getOriginal(), $changes);

            Log::info('IndividualRiskAssessmentViolenceRisk Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('individual_risk_assessment_violence_risk')
                ->performedOn($risk)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'individual_risk_assessment_id' => $risk->individual_risk_assessment_id,
                    'uuid' => $risk->uuid ?? null,
                ])
                ->log('Individual Risk Assessment Violence Risk record has been updated');

            $risk->save();
        }

        return $risk;
    }
}
