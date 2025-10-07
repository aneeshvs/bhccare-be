<?php

namespace App\ScheduleOfSupportService;

use App\Models\AgreementSignature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AgreementSignatureService
{
    public function save(array $data): AgreementSignature
    {
        $conditions = [
            'schedule_of_support_id' => $data['schedule_of_support_id'],
        ];

        $record = AgreementSignature::firstOrNew($conditions);
        $record->fill($data);

        if ($record->isDirty()) {
            $changes = $record->getDirty();
            $oldValues = array_intersect_key($record->getOriginal(), $changes);

            $record->save();

            Log::info('AgreementSignature changes', [
                'changes' => $changes,
                'original' => $oldValues,
            ]);

            activity()
                ->useLog('agreement_signature')
                ->performedOn($record)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $oldValues,
                    'schedule_of_support_id' => $record->schedule_of_support_id,
                    'uuid' => $record->uuid ?? null,
                ])
                ->log('AgreementSignature record updated');
        } else {
            $record->save();
        }

        return $record;
    }
}
