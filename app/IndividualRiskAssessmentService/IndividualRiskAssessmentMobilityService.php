<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessmentMobility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndividualRiskAssessmentMobilityService
{
    public function save(array $data): IndividualRiskAssessmentMobility
    {
        $mobility = IndividualRiskAssessmentMobility::firstOrNew([
            'individual_risk_assessment_id' => $data['individual_risk_assessment_id'],
        ]);

        $mobility->fill($data);

        if ($mobility->isDirty()) {
            $changes = $mobility->getDirty();
            $original = array_intersect_key($mobility->getOriginal(), $changes);

            Log::info('IndividualRiskAssessmentMobility Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('individual_risk_assessment_mobility')
                ->performedOn($mobility)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'individual_risk_assessment_id' => $mobility->individual_risk_assessment_id,
                    'uuid' => $mobility->uuid ?? null,
                ])
                ->log('Individual Risk Assessment Mobility record has been updated');

            $mobility->save();
        }

        return $mobility;
    }
}
