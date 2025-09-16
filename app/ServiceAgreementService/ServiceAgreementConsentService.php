<?php

namespace App\ServiceAgreementService;

use App\Models\ServiceAgreementConsent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceAgreementConsentService
{
    public function save(array $data): ServiceAgreementConsent
    {
        $conditions = [
            'service_agreement_id' => $data['service_agreement_id'],
        ];

        $consent = ServiceAgreementConsent::firstOrNew($conditions);
        $consent->fill($data);

        if ($consent->isDirty()) {
            $changes = $consent->getDirty();
            $original = array_intersect_key($consent->getOriginal(), $changes);

            Log::info('ServiceAgreementConsent Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('service_agreement_consent')
                ->performedOn($consent)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'user_id' => $data['user_id'] ?? null,
                    'service_agreement_id' => $consent->service_agreement_id,
                ])
                ->log('Service Agreement Consent record has been updated');

            $consent->save();
        }

        return $consent;
    }
}
