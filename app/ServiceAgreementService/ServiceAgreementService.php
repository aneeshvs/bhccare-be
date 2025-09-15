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

        $agreement = ServiceAgreement::firstOrNew($conditions);
        $agreement->fill($data);

        if ($agreement->isDirty()) {
            $changes = $agreement->getDirty();
            $original = array_intersect_key($agreement->getOriginal(), $changes);

            Log::info('ServiceAgreement Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('service_agreement')
                ->performedOn($agreement)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $agreement->user_id,
                    'client_type' => $agreement->client_type,
                    'uuid' => $agreement->uuid,
                    'service_agreement_id' => $agreement->id,
                ])
                ->log('Service Agreement record has been updated');

            $agreement->save();
        }

        return $agreement;
    }
}
