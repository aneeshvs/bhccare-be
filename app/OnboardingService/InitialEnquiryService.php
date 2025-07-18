<?php

namespace App\OnboardingService;

use App\Models\InitialEnquiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class InitialEnquiryService
{
    public function save(array $data): InitialEnquiry
{
    $conditions = [
        'user_id' => $data['user_id'],
        'client_type' => $data['client_type'],
    ];

    $initial = InitialEnquiry::firstOrNew($conditions);
    $initial->fill($data);

    if ($initial->isDirty()) {
        $changes = $initial->getDirty();
        $original = array_intersect_key($initial->getOriginal(), $changes);

        Log::info('InitialEnquiry Changes', [
            'dirty' => $changes,
            'original' => $original,
        ]);

        activity()
            ->useLog('initial_enquiry')
            ->performedOn($initial)
            ->causedBy(Auth::user())
            ->withProperties([
                'attributes' => $changes,
                'old' => $original,
                'staff_id' => $data['staff_id'] ?? null,
                'user_id' => $initial->user_id,
                'client_type' => $initial->client_type,
                'uuid' => $initial->uuid,
            ])
            ->log('InitialEnquiry record has been updated');

        $initial->save();
    }

    return $initial;
}

}
