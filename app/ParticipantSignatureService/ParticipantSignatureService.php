<?php

namespace App\ParticipantSignatureService;

use App\Models\ParticipantSignature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ParticipantSignatureService
{
    public function save(array $data): ParticipantSignature
    {
        $record = ParticipantSignature::firstOrNew([
            'user_id' => $data['user_id'],
            'client_type' => $data['client_type'],
        ]);
        if (!empty($data['uuid'])) {
            $conditions['uuid'] = $data['uuid'];
        }

        $isNew = !$record->exists;



        $record->fill($data);

        $changes = $record->getDirty();
        $original = $isNew ? [] : array_intersect_key($record->getOriginal(), $changes);

        $record->save(); // save first so uuid and id exist

        if ($isNew || !empty($changes)) {
            activity()
                ->useLog('participant_signature')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $isNew ? null : $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $record->user_id,
                    'client_type' => $record->client_type,
                    'uuid' => $record->uuid,
                    'participant_signature_id' => $record->id,
                ])
                ->log($isNew ? 'Participant Signature created' : 'Participant Signature updated');

            Log::info('ParticipantSignature Log:', [
                'is_new' => $isNew,
                'changes' => $changes,
                'original' => $original,
            ]);
        }

        return $record;
    }
}
