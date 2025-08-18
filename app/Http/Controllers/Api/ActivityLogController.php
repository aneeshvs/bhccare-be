<?php
namespace App\Http\Controllers\Api;
 use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\InitialEnquiry;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use App\Models\Staff;
use App\Models\SupportPlan;

use App\Models\StaffTypeMaster;

class ActivityLogController extends Controller
{
    public function index()
    {
        // You can filter or paginate here
        $logs = Activity::latest()->take(50)->get();


        return response()->json([
            'status' => true,
            'message' => 'Activity logs fetched successfully.',
            'data' => $logs
        ]);
    }




// public function exportLogsPdf(Request $request)
// {
//     $uuid = $request->query('uuid');

//     // Find first matching activity by UUID to get the client ID
//     $firstLog = Activity::where('properties->uuid', $uuid)->first();

//     if (!$firstLog) {
//         return response()->json(['message' => 'No activity log found for the given UUID.'], 404);
//     }

//     // Extract client ID from properties
//     $clientId = $firstLog->properties['user_id'] ?? null;

//     if (!$clientId) {
//         return response()->json(['message' => 'Client ID not found in activity log.'], 404);
//     }

//     // ✅ Get all logs related to this client from all onboarding steps
//     $logs = Activity::whereIn('log_name', [
//             'initial_enquiry',
//             'funding_detail',
//             'emergency_contact',
//             'schedule_of_care',
//             'cultural_background',
//             'ndis_goals',
//             'health_professional_detail',
//             'diagnosis_summary',
//             'health_information',
//             'healthcare_support_detail',
//             'behaviour_support',
//             'medical_alert',
//             'preventive_health_summary',
//             'support_information',
//         ])
//         ->where('properties->user_id', $clientId)
//         ->orderBy('created_at', 'desc')
//         ->get();

//     // 🔍 Parse properties JSON manually for display
//     foreach ($logs as $log) {
//         $log->parsed_properties = json_decode($log->getRawOriginal('properties'), true);
//     }

//     // ✅ Generate PDF with the full list
//     return Pdf::loadView('logs.pdf', [
//         'logs' => $logs,
//         'uuid' => $uuid
//     ])->download("activity-logs-{$uuid}.pdf");
// }

// In ActivityLogController.php



public function getLogsByUuid(Request $request)
{
    $uuid = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    $initial = InitialEnquiry::where('uuid', $uuid)->first();

    if (!$initial) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID. No InitialEnquiry found.'
        ], 404);
    }

    $query = Activity::where('properties->initial_enquiry_id', $initial->id);

    // Optional filter by table name (log_name)
    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        // Default to all onboarding-related logs
        $query->whereIn('log_name', [
            'initial_enquiry',
            'funding_detail',
            'emergency_contact',
            'schedule_of_care',
            'cultural_background',
            'ndis_goals',
            'health_professional_detail',
            'diagnosis_summary',
            'health_information',
            'healthcare_support_detail',
            'behaviour_support',
            'medical_alert',
            'preventive_health_summary',
            'support_information',
        ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // Step 1: Get all staff IDs from logs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();

    // Step 2: Get all staff records with stafftype
    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);

    // Step 3: Build ID => Name and Stafftype maps
    $staffNames = $staffRecords->pluck('name', 'id')->toArray();
    $stafftypeIdsFromStaff = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();

    // Step 4: Also get stafftype directly from logs (if available)
    $stafftypeIdsFromLogs = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();

    // Step 5: Merge both sets of IDs
    $stafftypeIds = collect($stafftypeIdsFromLogs)
        ->merge($stafftypeIdsFromStaff)
        ->unique()
        ->toArray();

    // Step 6: Fetch stafftype names
    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int)$id => $name])
        ->toArray();

    // ✅ Step 7: Filter by field name if given
                if (!empty($field) && $field !== 'all') {

                    $logs = $logs->filter(function ($log) use ($field) {
                        $properties = $log->properties ?? [];
                        $attributes = $properties['attributes'] ?? [];
                        $old = $properties['old'] ?? [];

                        // ✅ Also check top-level properties like 'type_of_service' or 'role'
                        return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
                    })->values(); // reindex the collection
                }



    // ✅ Map and format log data
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old = $properties['old'] ?? [];

        $formattedAttributes = collect($attributes)->map(fn($val) => is_bool($val) ? ($val ? 'Yes' : 'No') : $val);
        $formattedOld = collect($old)->map(fn($val) => is_bool($val) ? ($val ? 'Yes' : 'No') : $val);

        $staffId = $properties['staff_id'] ?? null;
        $stafftypeId = $properties['stafftype'] ?? null;

        if (!$stafftypeId && $staffId) {
            $staff = \App\Models\Staff::find($staffId);
            $stafftypeId = $staff?->stafftype;
        }

        return [
            'id' => $log->id,
            'log_name' => $log->log_name,
            'description' => $log->description,
            'created_at' => $log->created_at->toDateTimeString(),
            'attributes' => $formattedAttributes,
            'old' => $formattedOld,
            'user_id' => $properties['user_id'] ?? null,
            'client_type' => $properties['client_type'] ?? null,
            'stafftype_id' => $stafftypeId,
            'stafftype_name' => $stafftypenames[(int)$stafftypeId] ?? null,
            'staff_id' => $staffId,
            'staff_name' => $staffNames[$staffId] ?? null,
            'uuid' => $properties['uuid'] ?? null,
        ];
    });

    return response()->json([
        'status' => true,
        'message' => 'Activity logs fetched successfully.',
        'data' => $response,
    ]);
}

public function getLogsByUuidSupport(Request $request)
{
    $uuid = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    $support =SupportPlan::where('uuid', $uuid)->first();

    if (!$support) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID. No support plan found.'
        ], 404);
    }

    $query = Activity::where('properties->support_plan_id', $support->id);

    // Optional filter by table name (log_name)
    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        // Default to all onboarding-related logs
        $query->whereIn('log_name', [
            'support_plan',
            'support_plan_approval',
            'support_plan_representative',
            'support_plan_care_partner',
            'keeping_in_touch',
            'non_response_visit_plan',
            'participant_detail',
            'support_plan_contact_detail',
            'support_plan_contact_detail_secondary',
            'support_plan_funding',
            'support_plan_service',
            'employee_matching_need',
            ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // Step 1: Get all staff IDs from logs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();

    // Step 2: Get all staff records with stafftype
    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);

    // Step 3: Build ID => Name and Stafftype maps
    $staffNames = $staffRecords->pluck('name', 'id')->toArray();
    $stafftypeIdsFromStaff = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();

    // Step 4: Also get stafftype directly from logs (if available)
    $stafftypeIdsFromLogs = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();

    // Step 5: Merge both sets of IDs
    $stafftypeIds = collect($stafftypeIdsFromLogs)
        ->merge($stafftypeIdsFromStaff)
        ->unique()
        ->toArray();

    // Step 6: Fetch stafftype names
    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int)$id => $name])
        ->toArray();

    // ✅ Step 7: Filter by field name if given
                if (!empty($field) && $field !== 'all') {

                    $logs = $logs->filter(function ($log) use ($field) {
                        $properties = $log->properties ?? [];
                        $attributes = $properties['attributes'] ?? [];
                        $old = $properties['old'] ?? [];

                        // ✅ Also check top-level properties like 'type_of_service' or 'role'
                        return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
                    })->values(); // reindex the collection
                }



    // ✅ Map and format log data
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old = $properties['old'] ?? [];

        $formattedAttributes = collect($attributes)->map(fn($val) => is_bool($val) ? ($val ? 'Yes' : 'No') : $val);
        $formattedOld = collect($old)->map(fn($val) => is_bool($val) ? ($val ? 'Yes' : 'No') : $val);

        $staffId = $properties['staff_id'] ?? null;
        $stafftypeId = $properties['stafftype'] ?? null;

        if (!$stafftypeId && $staffId) {
            $staff = \App\Models\Staff::find($staffId);
            $stafftypeId = $staff?->stafftype;
        }

        return [
            'id' => $log->id,
            'log_name' => $log->log_name,
            'description' => $log->description,
            'created_at' => $log->created_at->toDateTimeString(),
            'attributes' => $formattedAttributes,
            'old' => $formattedOld,
            'user_id' => $properties['user_id'] ?? null,
            'client_type' => $properties['client_type'] ?? null,
            'stafftype_id' => $stafftypeId,
            'stafftype_name' => $stafftypenames[(int)$stafftypeId] ?? null,
            'staff_id' => $staffId,
            'staff_name' => $staffNames[$staffId] ?? null,
            'uuid' => $properties['uuid'] ?? null,
        ];
    });

    return response()->json([
        'status' => true,
        'message' => 'Activity logs fetched successfully.',
        'data' => $response,
    ]);
}

}
