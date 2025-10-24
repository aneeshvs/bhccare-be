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
            'user_id'     => $data['user_id'],
            'client_type' => $data['client_type'],
        ];

        $record = ConfidentialInformationForm::firstOrNew($conditions);
        $isNew = !$record->exists; // Detect first-time creation

        $record->fill($data);

        // Detect changes before save
        $changes = $record->getDirty();
        $original = $isNew ? [] : array_intersect_key($record->getOriginal(), $changes);

        // Save first so ID/UUID exists in DB
        $record->save();

        if ($isNew || !empty($changes)) {
            activity()
                ->useLog('confidential_information_form')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old'        => $isNew ? null : $original,
                    'staff_id'   => $data['staff_id'] ?? null,
                    'user_id'    => $record->user_id,
                    'client_type'=> $record->client_type,
                    'uuid'       => $record->uuid,
                    'confidential_information_form_id' => $record->id,
                ])
                ->log($isNew
                    ? 'Confidential Information Form created'
                    : 'Confidential Information Form updated'
                );

            Log::info('ConfidentialInformationForm Change Logged', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $original,
            ]);
        }

        return $record;
    }
}
