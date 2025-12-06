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
        if (!empty($data['uuid'])) {
            $conditions['uuid'] = $data['uuid'];
        }

        $initial = InitialEnquiry::firstOrNew($conditions);
        $isNew = !$initial->exists; // Detect first-time create

        $initial->fill($data);

        // Detect changed fields
        $changes = $initial->getDirty();
        $original = $isNew ? [] : array_intersect_key($initial->getOriginal(), $changes);

        // Save first (important to ensure uuid & id exist)
        $initial->save();

        // Log when created or updated
        if ($isNew || !empty($changes)) {
            activity()
                ->useLog('initial_enquiry')
                ->performedOn($initial)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $initial->user_id,
                    'client_type' => $initial->client_type,
                    'uuid' => $initial->uuid,
                    'initial_enquiry_id' => $initial->id,
                ])
                ->log($isNew
                    ? 'InitialEnquiry record created'
                    : 'InitialEnquiry record updated'
                );

            Log::info('InitialEnquiry Change Logged', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $original,
            ]);
        }

        return $initial;
    }
}
