<?php

namespace App\ConfidentialInformationFormService;

use App\Models\ConfidentialInformationForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConfidentialInformationFormService
{
    public function save(array $data): ConfidentialInformationForm
    {
        $conditions = [
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ];

        $record = ConfidentialInformationForm::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('ConfidentialInformationForm Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            activity()
                ->useLog('confidential_information_form')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $record->user_id,
                    'client_type' => $record->client_type,
                    'uuid' => $record->uuid,
                    'confidential_information_form_id' => $record->id,
                ])
                ->log('Confidential Information Form updated');

            $record->save();
        }

        return $record;
    }
}
