<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessmentCommunication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndividualRiskAssessmentCommunicationService
{
    public function save(array $data): IndividualRiskAssessmentCommunication
    {
        $communication = IndividualRiskAssessmentCommunication::firstOrNew([
            'individual_risk_assessment_id' => $data['individual_risk_assessment_id'],
        ]);

        $communication->fill($data);

        if ($communication->isDirty()) {
            $changes = $communication->getDirty();
            $original = array_intersect_key($communication->getOriginal(), $changes);

            Log::info('IndividualRiskAssessmentCommunication Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('individual_risk_assessment_communication')
                ->performedOn($communication)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'individual_risk_assessment_id' => $communication->individual_risk_assessment_id,
                    'uuid' => $communication->uuid ?? null,
                ])
                ->log('Individual Risk Assessment Communication record has been updated');

            $communication->save();
        }

        return $communication;
    }
}
