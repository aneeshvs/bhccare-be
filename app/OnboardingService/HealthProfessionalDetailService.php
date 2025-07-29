<?php

namespace App\OnboardingService;

use App\Models\HealthProfessionalDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HealthProfessionalDetailService
{
    public function saveMany(array $items, int $initialEnquiryId): array
    {
        $saved = [];

        foreach ($items as $item) {
            if (empty($item['role'])) {
                continue;
            }

            $record = HealthProfessionalDetail::firstOrNew([
                'initial_enquiry_id' => $initialEnquiryId,
                'role' => $item['role'],
            ]);

            $original = $record->exists ? $record->getOriginal() : [];

            $record->fill($item);
            $record->initial_enquiry_id = $initialEnquiryId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);
                $record->save();

                // ✅ Fallback from InitialEnquiry relationship if not passed
                $initial = $record->initialEnquiry;

                $uuid = $item['uuid'] ?? optional($initial)->uuid;
                $staffId = $item['staff_id'] ?? optional($initial)->staff_id;
                $clientType = $item['client_type'] ?? optional($initial)->client_type;
                $userId = $item['user_id'] ?? optional($initial)->user_id;

                Log::info("HealthProfessionalDetail: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => $uuid,
                ]);

                activity()
                    ->useLog('health_professional_detail')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'initial_enquiry_id' => $record->initial_enquiry_id,
                        'uuid' => $uuid,
                        'client_type' => $clientType,
                        'staff_id' => $staffId,
                        'user_id' => $userId,
                    ])
                    ->log('HealthProfessionalDetail record has been updated');
            } else {
                $record->save();
            }

            $saved[] = $record;
        }

        return $saved;
    }
}
