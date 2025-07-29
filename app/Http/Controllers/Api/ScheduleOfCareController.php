<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InitialEnquiry;
use App\Models\ScheduleOfCare;
use Illuminate\Support\Facades\Auth;

class ScheduleOfCareController extends Controller
{

   public function remove(Request $request)
{
    $uuid = $request->input('uuid');
    $typeOfService = $request->input('type_of_service');

    if (!$uuid || !$typeOfService) {
        return response()->json([
            'status' => false,
            'message' => 'UUID and Type of Service are required.',
        ], 400);
    }

    $initial = InitialEnquiry::where('uuid', $uuid)->first();

    if (!$initial) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID.',
        ], 404);
    }

    $record = ScheduleOfCare::where('initial_enquiry_id', $initial->id)
        ->where('type_of_service', $typeOfService)
        ->first();

    if (!$record) {
        return response()->json([
            'status' => false,
            'message' => 'Schedule of Care entry not found.',
        ], 404);
    }



    $record->delete();

        activity()
            ->useLog('schedule_of_care')
            ->performedOn($record)
            ->causedBy(Auth::user())
            ->withProperties([
                    'attributes' => [
                    'type_of_service' => $typeOfService,
                ],



            'initial_enquiry_id' => $record->initial_enquiry_id,
            'uuid' => $schedule['uuid'] ?? optional($record->initialEnquiry)->uuid,
            'client_type' => $schedule['client_type'] ?? optional($record->initialEnquiry)->client_type,
            'staff_id' => $schedule['staff_id'] ?? optional($record->initialEnquiry)->staff_id,
            'user_id' => $schedule['user_id'] ?? optional($record->initialEnquiry)->user_id,
        ])
        ->log('ScheduleOfCare entry deleted');

    return response()->json([
        'status' => true,
        'message' => 'Schedule of Care removed successfully.',
    ]);
}

}
