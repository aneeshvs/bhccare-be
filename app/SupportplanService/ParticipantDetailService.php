<?php

namespace App\SupportplanService;


use App\Models\ParticipantDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ParticipantDetailService
{
    public function save(array $data): ParticipantDetail
    {
        $participant = ParticipantDetail::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);



        $participant->fill($data);

        if ($participant->isDirty()) {
            $changes = $participant->getDirty();
            $original = array_intersect_key($participant->getOriginal(), $changes);

            $participant->save();

            activity()
                ->useLog('participant_detail')
                ->performedOn($participant)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $participant->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('ParticipantDetail record has been updated');
        }

        return $participant;
    }
}
