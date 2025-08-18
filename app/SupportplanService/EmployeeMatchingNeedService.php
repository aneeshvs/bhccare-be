<?php

namespace App\SupportplanService;

use App\Models\EmployeeMatchingNeed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmployeeMatchingNeedService
{
    public function save(array $data): EmployeeMatchingNeed
    {
        $need = EmployeeMatchingNeed::firstOrNew([
            'support_plan_id' => $data['support_plan_id'],
        ]);

        $need->fill($data);

        if ($need->isDirty()) {
            $changes = $need->getDirty();
            $original = array_intersect_key($need->getOriginal(), $changes);

            Log::info('EmployeeMatchingNeed Changes', [
                'dirty' => $changes,
                'original' => $original,
            ]);

            $need->save();

            activity()
                ->useLog('employee_matching_need')
                ->performedOn($need)
                ->causedBy(Auth::user())
                ->withProperties([
                    'attributes' => $changes,
                    'old' => $original,
                    'staff_id' => $data['staff_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'client_type' => $data['client_type'] ?? null,
                    'uuid' => $need->uuid,
                    'support_plan_id' => $data['support_plan_id'],
                ])
                ->log('EmployeeMatchingNeed record has been updated');
        }

        return $need;
    }
}
