<?php

namespace App\ServiceAgreementService;

use App\Models\ServiceAgreement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceAgreementService
{
    public function save(array $data): ServiceAgreement
    {
        $conditions = [
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ];
        if (!empty($data['uuid'])) {
            $conditions['uuid'] = $data['uuid'];
        }

        $agreement = ServiceAgreement::firstOrNew($conditions);
        $isNew = !$agreement->exists; // Detect create vs update

        // Keep before-fill original values
        $original = $agreement->getOriginal();

        // Apply changes
        $agreement->fill($data);

        // Detect changed columns
        $changes = $agreement->getDirty();
        $oldValues = $isNew ? [] : array_intersect_key($original, $changes);

        // Save before logging
        $agreement->save();

        // Log only if new record or updates happened
        if ($isNew || !empty($changes)) {

            activity()
                ->useLog('service_agreement')
                ->performedOn($agreement)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $oldValues,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $agreement->user_id,
                    'client_type' => $agreement->client_type,
                    'uuid' => $agreement->uuid,
                    'service_agreement_id' => $agreement->id,
                ])
                ->log($isNew
                    ? 'Service Agreement record created'
                    : 'Service Agreement record updated'
                );

            Log::info('ServiceAgreement Change Logged', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $oldValues,
            ]);
        }

        return $agreement;
    }
}
