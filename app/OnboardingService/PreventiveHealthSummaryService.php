<?php

namespace App\OnboardingService;

use App\Models\PreventiveHealthSummary;
use Illuminate\Support\Facades\Auth;

class PreventiveHealthSummaryService
{
    public function save(array $data): PreventiveHealthSummary
    {
        $summary = PreventiveHealthSummary::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        $summary->fill($data);

        if ($summary->isDirty()) {
            $changes = $summary->getDirty();
            $original = array_intersect_key($summary->getOriginal(), $changes);

            $summary->save();

            activity()
                ->useLog('preventive_health_summary')
                ->performedOn($summary)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $summary->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'uuid' => $data['uuid'] ?? null,
                ])
                ->log('PreventiveHealthSummary record has been updated');
        } else {
            $summary->save(); // Save to insert if new
        }

        return $summary;
    }
}
