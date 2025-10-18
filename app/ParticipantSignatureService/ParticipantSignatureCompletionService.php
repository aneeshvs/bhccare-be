<?php

namespace App\ParticipantSignatureService;

use App\Models\ParticipantSignature;

class ParticipantSignatureCompletionService
{
    public function calculate(ParticipantSignature $record): int
    {
        $totalFields = 2; // participant_signature + date_signed
        $filled = 0;

        if (!empty($record->participant_signature)) $filled++;
        if (!empty($record->date_signed)) $filled++;

        return intval(($filled / $totalFields) * 100);
    }
}
