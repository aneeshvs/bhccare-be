<?php

namespace App\IndividualRiskAssessmentService;

use App\Models\IndividualRiskAssessmentDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndividualRiskAssessmentDetailService
{
    public function save(array $data): IndividualRiskAssessmentDetail
    {

        $conditions = [
            'individual_risk_assessment_id' => $data['individual_risk_assessment_id'],
        ];



        $detail = IndividualRiskAssessmentDetail::firstOrNew($conditions);

        $detail->fill($data);

        if ($detail->isDirty()) {
            $changes = $detail->getDirty();
            $original = array_intersect_key($detail->getOriginal(), $changes);

            Log::info('IndividualRiskAssessmentDetail Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('individual_risk_assessment_detail')
                ->performedOn($detail)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'individual_risk_assessment_id' => $detail->individual_risk_assessment_id,
                    'uuid' => $detail->uuid ?? null,
                ])
                ->log('Individual Risk Assessment Detail has been updated');

            $detail->save();
        }

        return $detail;
    }
}
