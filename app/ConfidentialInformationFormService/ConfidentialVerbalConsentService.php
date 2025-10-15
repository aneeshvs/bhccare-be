<?php

namespace App\ConfidentialInformationFormService;

use App\Models\ConfidentialVerbalConsent;
use App\Models\ConfidentialInformationForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConfidentialVerbalConsentService
{
    public function save(array $data): ConfidentialVerbalConsent
    {
        // Step 1: Find or create the record
        $record = ConfidentialVerbalConsent::firstOrNew([
            'confidential_information_form_id' => $data['confidential_information_form_id'],
        ]);

        $record->fill($data);

        // Step 2: Load parent form for context
        $form = ConfidentialInformationForm::find($data['confidential_information_form_id']);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('Verbal Consent Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('confidential_verbal_consent')
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
                ->log('Confidential Verbal Consent record updated');
        }

        $record->save();
        return $record;
    }
}
