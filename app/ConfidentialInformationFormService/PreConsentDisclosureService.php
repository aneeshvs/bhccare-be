<?php

namespace App\ConfidentialInformationFormService;

use App\Models\PreConsentDisclosure;
use App\Models\ConfidentialInformationForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PreConsentDisclosureService
{
    public function save(array $data): PreConsentDisclosure
    {
        $record = PreConsentDisclosure::firstOrNew([
            'confidential_information_form_id' => $data['confidential_information_form_id'],
        ]);

        $record->fill($data);

        $form = ConfidentialInformationForm::find($data['confidential_information_form_id']);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            activity()
                ->useLog('pre_consent_disclosure')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? optional($form)->staff_id,
                    'user_id' => optional($form)->user_id,
                    'client_type' => optional($form)->client_type,
                    'uuid' => $record->uuid ?? optional($form)->uuid,
                    'confidential_information_form_id' => $record->confidential_information_form_id,
                ])
                ->log('Pre-Consent Disclosure record updated');
        }

        $record->save();
        return $record;
    }
}
