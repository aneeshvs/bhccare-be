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

        // Convert base64 signature to binary if sent as base64
        if (!empty($data['participant_signature']) && is_string($data['participant_signature'])) {
            if (str_starts_with($data['participant_signature'], 'data:image')) {
                $data['participant_signature'] = base64_decode(
                    preg_replace('#^data:image/\w+;base64,#i', '', $data['participant_signature'])
                );
            }
        }

        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $original = array_intersect_key($record->getOriginal(), $changes);

            Log::info('Participant Signature Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $record->save();

            activity()
                ->useLog('participant_signature')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $record->user_id,
                    'client_type' => $record->client_type,
                    'uuid' => $record->uuid,
                    'participant_signature_id' =>$record->id,
                ])
                ->log('Participant Signature updated');
        }

        return $record;
    }
}
