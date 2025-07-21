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
            // Skip if empty name or role
            if (empty($item['role']) ) {
                continue;
            }

            // Match by name, role, and initial_enquiry_id
            $record = HealthProfessionalDetail::firstOrNew([
                'initial_enquiry_id' => $initialEnquiryId,

                'role' => $item['role'],
            ]);

            // Capture original state for logging
            $original = $record->exists ? $record->getOriginal() : [];

            // Update with new values
            $record->fill($item);
            $record->initial_enquiry_id = $initialEnquiryId;

            if ($record->isDirty()) {
                $changes = $record->getDirty();
                $oldValues = array_intersect_key($original, $changes);

                $record->save();

                Log::info("HealthProfessionalDetail: changes", [
                    'changes' => $changes,
                    'original' => $oldValues,
                    'uuid' => optional($record->initialEnquiry)->uuid,
                ]);

                activity()
                    ->useLog('health_professional_detail')
                    ->performedOn($record)
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'attributes' => $changes,
                        'old' => $oldValues,
                        'initial_enquiry_id' => $record->initial_enquiry_id,
                        'uuid' => optional($record->initialEnquiry)->uuid,
                        'client_type' => $item['client_type'] ?? null,
                        'staff_id' => $item['staff_id'] ?? null,
                        'user_id' => $item['user_id'] ?? null,
                    ])
                    ->log('HealthProfessionalDetail record has been updated');
            } else {
                $record->save(); // save silently
            }

            $saved[] = $record;
        }

        return $saved;
    }
}
