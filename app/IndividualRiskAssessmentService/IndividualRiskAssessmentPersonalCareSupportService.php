<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessmentPersonalCareSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndividualRiskAssessmentPersonalCareSupportService
{
    public function save(array $data): IndividualRiskAssessmentPersonalCareSupport
    {
        $care = IndividualRiskAssessmentPersonalCareSupport::firstOrNew([
            'individual_risk_assessment_id' => $data['individual_risk_assessment_id'],
        ]);

        $care->fill($data);

        if ($care->isDirty()) {
            $changes = $care->getDirty();
            $original = array_intersect_key($care->getOriginal(), $changes);

            Log::info('IndividualRiskAssessmentPersonalCareSupport Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('individual_risk_assessment_personal_care')
                ->performedOn($care)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'individual_risk_assessment_id' => $care->individual_risk_assessment_id,
                    'uuid' => $care->uuid ?? null,
                ])
                ->log('Individual Risk Assessment Personal Care record has been updated');

            $care->save();
        }

        return $care;
    }
}
