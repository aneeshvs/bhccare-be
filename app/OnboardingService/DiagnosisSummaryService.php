<?php

namespace App\OnboardingService;

use App\Models\DiagnosisSummary;
use Illuminate\Support\Facades\Auth;

class DiagnosisSummaryService
{
    public function save(array $data): DiagnosisSummary
    {
        $diagnosis = DiagnosisSummary::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $diagnosis->fill([
            'primary_diagnosis' => $data['primary_diagnosis'] ?? null,
            'secondary_diagnosis' => $data['secondary_diagnosis'] ?? null,
        ]);

        if ($diagnosis->isDirty()) {
            $changes = $diagnosis->getDirty();
            $original = array_intersect_key($diagnosis->getOriginal(), $changes);

            $diagnosis->save();

            activity()
                ->useLog('diagnosis_summary')
                ->performedOn($diagnosis)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $diagnosis->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                     'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('DiagnosisSummary record has been updated');
        } else {
            $diagnosis->save(); // still ensure it's stored
        }

        return $diagnosis;
    }
}
