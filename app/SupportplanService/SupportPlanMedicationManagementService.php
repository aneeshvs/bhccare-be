<?php

namespace App\SupportplanService;

use App\Models\SupportPlanMedicationManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportPlanMedicationManagementService
{
    public function save(array $data): SupportPlanMedicationManagement
    {
        $medication = SupportPlanMedicationManagement::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $medication->fill($data);

        if ($medication->isDirty()) {
            $changes = $medication->getDirty();
            $original = array_intersect_key($medication->getOriginal(), $changes);

            Log::info('SupportPlanMedicationManagement Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $medication->save();

            activity()
                ->useLog('support_plan_medication_management')
                ->performedOn($medication)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $medication->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('SupportPlanMedicationManagement record updated');
        }

        return $medication;
    }
}
