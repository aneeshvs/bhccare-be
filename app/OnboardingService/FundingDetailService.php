<?php

namespace App\OnboardingService;

use App\Models\FundingDetail;
use Illuminate\Support\Facades\Auth;

class FundingDetailService
{
    public function save(array $data): FundingDetail
    {
        // Try to find existing record or create new instance
        $funding = FundingDetail::firstOrNew([
            'initial_enquiry_id' => $data['initial_enquiry_id'],
        ]);

        // Fill data
        $funding->fill($data);

        // Log only if changes occurred
        if ($funding->isDirty()) {
            $changes = $funding->getDirty();
            $original = array_intersect_key($funding->getOriginal(), $changes);

            $funding->save();

            activity()
                ->useLog('funding_detail')
                ->performedOn($funding)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'initial_enquiry_id' => $funding->initial_enquiry_id,
                    'client_type' => $data['client_type'] ?? null, // ✅ Add this
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,   // ✅ for filtering by client
                    'uuid' => $data['uuid'] ?? null,         // ✅ for PDF export by uuid
                ])
                ->log('FundingDetail record has been updated');

        } else {
            $funding->save(); // Just save if no changes, to avoid missing record
        }

        return $funding;
    }
}
