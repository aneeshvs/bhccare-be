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

        $checkboxFields = ['male', 'female', 'no_preference'];

        $formattedAttributes = collect($attributes)->map(function ($val, $key) use ($checkboxFields) {
            if (in_array($key, $checkboxFields)) {
                // Only these fields: checked/unchecked
                return $val ? 'checked' : 'unchecked';
            } elseif (is_bool($val) || $val === 0 || $val === 1 || $val === '0' || $val === '1') {
                // Other boolean fields: Yes/No
                return $val ? 'Yes' : 'No';
            }
            return $val;
        });

        $formattedOld = collect($old)->map(function ($val, $key) use ($checkboxFields) {
            if (in_array($key, $checkboxFields)) {
                return $val ? 'checked' : 'unchecked';
            } elseif (is_bool($val) || $val === 0 || $val === 1 || $val === '0' || $val === '1') {
                return $val ? 'Yes' : 'No';
            }
            return $val;
        });


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
            'support_plan_my_goal',
            'support_plan_living_arrangement',
            'support_plan_general_health',
            'support_plan_medication_management',
            'support_plan_mobility_transfer',
            'support_plan_falls_risk',
            'support_plan_cognition',
            'support_plan_behaviour_support',
            'support_plan_personal_care',
            'support_plan_continence',
            'support_plan_vision',
            'support_plan_hearing',
            'support_plan_skin_condition',
            'support_plan_dietary',
            'support_plan_pain_management',
            'support_plan_social_connection',
            'support_plan_home_maintenance',
            'support_plan_financial_support',
            'support_plan_informal_support',
            'support_plan_emergency_readiness',
            'support_plan_fire_heat_readiness',
            'support_plan_storm_flooding',
            'support_plan_telecommunication_outage',
            'support_plan_power_outage',
            'support_plan_end_of_life_advanced_care_planning'

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

        $formattedAttributes = collect($attributes)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));
       $formattedOld = collect($old)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));

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

public function getLogsByUuidServiceAgreement(Request $request)
{
    $uuid = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    $agreement = \App\Models\ServiceAgreement::where('uuid', $uuid)->first();

    if (!$agreement) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid UUID. No service agreement found.'
        ], 404);
    }

    $query = \Spatie\Activitylog\Models\Activity::where('properties->service_agreement_id', $agreement->id);

    // Optional filter by table name (log_name)
    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        $query->whereIn('log_name', [
            'service_agreement',
            'service_agreement_consent',


        ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // Step 1: Extract staff IDs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();

    // Step 2: Fetch staff records
    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);

    $staffNames = $staffRecords->pluck('name', 'id')->toArray();
    $stafftypeIdsFromStaff = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();
    $stafftypeIdsFromLogs = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();

    $stafftypeIds = collect($stafftypeIdsFromLogs)->merge($stafftypeIdsFromStaff)->unique()->toArray();

    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int)$id => $name])
        ->toArray();

    // Step 3: Filter by specific field if requested
    if (!empty($field) && $field !== 'all') {
        $logs = $logs->filter(function ($log) use ($field) {
            $properties = $log->properties ?? [];
            $attributes = $properties['attributes'] ?? [];
            $old = $properties['old'] ?? [];

            return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
        })->values();
    }

    // Step 4: Format response
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old = $properties['old'] ?? [];

        $formattedAttributes = collect($attributes)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));
       $formattedOld = collect($old)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));


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
        'message' => 'Service Agreement activity logs fetched successfully.',
        'data' => $response,
    ]);
}

public function getLogsByUuidSupportCarePlan(Request $request)
{
    $uuid  = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    $supportCarePlan = \App\Models\SupportCarePlan::where('uuid', $uuid)->first();

    if (!$supportCarePlan) {
        return response()->json([
            'status'  => false,
            'message' => 'Invalid UUID. No support care plan found.'
        ], 404);
    }

    $query = \Spatie\Activitylog\Models\Activity::where('properties->support_care_plan_id', $supportCarePlan->id);

    // Optional filter by table name (log_name)
    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        $query->whereIn('log_name', [
            'support_care_plan',
            'alternate_decision_maker',
            'sil_goals',
            'support_coordination_goals',
            'support_care_plan_communication',
            'support_care_plan_emergency_disaster',
            'support_care_plan_emergency_contacts',
            'support_care_plan_important_contacts',
            'support_care_plan_local_services_contacts',
            'support_care_plan_emergency_scenarios'
        ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // Step 1: Extract staff IDs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();

    // Step 2: Fetch staff records
    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);

    $staffNames             = $staffRecords->pluck('name', 'id')->toArray();
    $stafftypeIdsFromStaff  = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();
    $stafftypeIdsFromLogs   = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();
    $stafftypeIds           = collect($stafftypeIdsFromLogs)->merge($stafftypeIdsFromStaff)->unique()->toArray();

    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int) $id => $name])
        ->toArray();

    // Step 3: Filter by specific field if requested
    if (!empty($field) && $field !== 'all') {
        $logs = $logs->filter(function ($log) use ($field) {
            $properties  = $log->properties ?? [];
            $attributes  = $properties['attributes'] ?? [];
            $old         = $properties['old'] ?? [];

            return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
        })->values();
    }

    // Step 4: Format response
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old        = $properties['old'] ?? [];

         $formattedAttributes = collect($attributes)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));
       $formattedOld = collect($old)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));

        $staffId     = $properties['staff_id'] ?? null;
        $stafftypeId = $properties['stafftype'] ?? null;

        if (!$stafftypeId && $staffId) {
            $staff       = \App\Models\Staff::find($staffId);
            $stafftypeId = $staff?->stafftype;
        }

        return [
            'id'              => $log->id,
            'log_name'        => $log->log_name,
            'description'     => $log->description,
            'created_at'      => $log->created_at->toDateTimeString(),
            'attributes'      => $formattedAttributes,
            'old'             => $formattedOld,
            'user_id'         => $properties['user_id'] ?? null,
            'client_type'     => $properties['client_type'] ?? null,
            'stafftype_id'    => $stafftypeId,
            'stafftype_name'  => $stafftypenames[(int) $stafftypeId] ?? null,
            'staff_id'        => $staffId,
            'staff_name'      => $staffNames[$staffId] ?? null,
            'uuid'            => $properties['uuid'] ?? null,
        ];
    });

    return response()->json([
        'status'  => true,
        'message' => 'Support Care Plan activity logs fetched successfully.',
        'data'    => $response,
    ]);
}

public function getLogsByUuidRiskAssessment(Request $request)
{
    $uuid  = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    // 1. Validate UUID against Risk Assessment table
    $riskAssessment = \App\Models\IndividualRiskAssessment::where('uuid', $uuid)->first();

    if (!$riskAssessment) {
        return response()->json([
            'status'  => false,
            'message' => 'Invalid UUID. No risk assessment found.'
        ], 404);
    }

    // 2. Build activity log query
    $query = \Spatie\Activitylog\Models\Activity::where('properties->individual_risk_assessment_id', $riskAssessment->id);

    // Optional filter by table (log_name)
    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        $query->whereIn('log_name', [
            'individual_risk_assessment',
            'individual_risk_assessment_detail',
            'individual_risk_assessment_communication',
            'individual_risk_assessment_cognition',
            'individual_risk_assessment_mobility',
            'individual_risk_assessment_personal_care',
            'plan_manual_handlings',
            'individual_risk_assessment_violence_risk',

        ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // 3. Extract staff IDs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();

    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);
    $staffNames   = $staffRecords->pluck('name', 'id')->toArray();

    $stafftypeIdsFromStaff  = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();
    $stafftypeIdsFromLogs   = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();
    $stafftypeIds           = collect($stafftypeIdsFromLogs)->merge($stafftypeIdsFromStaff)->unique()->toArray();

    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int) $id => $name])
        ->toArray();

    // 4. Optional filter by field
    if (!empty($field) && $field !== 'all') {
        $logs = $logs->filter(function ($log) use ($field) {
            $properties  = $log->properties ?? [];
            $attributes  = $properties['attributes'] ?? [];
            $old         = $properties['old'] ?? [];

            return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
        })->values();
    }

    // 5. Format response
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old        = $properties['old'] ?? [];

        $formattedAttributes = collect($attributes)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));
       $formattedOld = collect($old)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));

        $staffId     = $properties['staff_id'] ?? null;
        $stafftypeId = $properties['stafftype'] ?? null;

        if (!$stafftypeId && $staffId) {
            $staff       = \App\Models\Staff::find($staffId);
            $stafftypeId = $staff?->stafftype;
        }

        return [
            'id'              => $log->id,
            'log_name'        => $log->log_name,
            'description'     => $log->description,
            'created_at'      => $log->created_at->toDateTimeString(),
            'attributes'      => $formattedAttributes,
            'old'             => $formattedOld,
            'user_id'         => $properties['user_id'] ?? null,
            'client_type'     => $properties['client_type'] ?? null,
            'stafftype_id'    => $stafftypeId,
            'stafftype_name'  => $stafftypenames[(int) $stafftypeId] ?? null,
            'staff_id'        => $staffId,
            'staff_name'      => $staffNames[$staffId] ?? null,
            'uuid'            => $properties['uuid'] ?? null,
        ];
    });

    return response()->json([
        'status'  => true,
        'message' => 'Risk Assessment activity logs fetched successfully.',
        'data'    => $response,
    ]);
}

public function getLogsByUuidSchedule(Request $request)
{
    $uuid  = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    // 1. Validate UUID against ScheduleOfSupports table
    $schedule = \App\Models\ScheduleOfSupport::where('uuid', $uuid)->first();

    if (!$schedule) {
        return response()->json([
            'status'  => false,
            'message' => 'Invalid UUID. No Schedule of Supports found.'
        ], 404);
    }

    // 2. Build activity log query
    $query = \Spatie\Activitylog\Models\Activity::where('properties->schedule_of_support_id', $schedule->id);

    // Optional filter by table (log_name)
    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        $query->whereIn('log_name', [
            'schedule_of_support',
            'funded_support',
            'unfunded_support',
            'agreement_signature',

        ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // 3. Extract staff IDs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();

    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);
    $staffNames   = $staffRecords->pluck('name', 'id')->toArray();

    $stafftypeIdsFromStaff  = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();
    $stafftypeIdsFromLogs   = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();
    $stafftypeIds           = collect($stafftypeIdsFromLogs)->merge($stafftypeIdsFromStaff)->unique()->toArray();

    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int) $id => $name])
        ->toArray();

    // 4. Optional filter by field
    if (!empty($field) && $field !== 'all') {
        $logs = $logs->filter(function ($log) use ($field) {
            $properties  = $log->properties ?? [];
            $attributes  = $properties['attributes'] ?? [];
            $old         = $properties['old'] ?? [];

            return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
        })->values();
    }

    // 5. Format response
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old        = $properties['old'] ?? [];

        $formattedAttributes = collect($attributes)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));
       $formattedOld = collect($old)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));

        $staffId     = $properties['staff_id'] ?? null;
        $stafftypeId = $properties['stafftype'] ?? null;

        if (!$stafftypeId && $staffId) {
            $staff       = \App\Models\Staff::find($staffId);
            $stafftypeId = $staff?->stafftype;
        }

        return [
            'id'              => $log->id,
            'log_name'        => $log->log_name,
            'description'     => $log->description,
            'created_at'      => $log->created_at->toDateTimeString(),
            'attributes'      => $formattedAttributes,
            'old'             => $formattedOld,
            'user_id'         => $properties['user_id'] ?? null,
            'client_type'     => $properties['client_type'] ?? null,
            'stafftype_id'    => $stafftypeId,
            'stafftype_name'  => $stafftypenames[(int) $stafftypeId] ?? null,
            'staff_id'        => $staffId,
            'staff_name'      => $staffNames[$staffId] ?? null,
            'uuid'            => $properties['uuid'] ?? null,
        ];
    });

    return response()->json([
        'status'  => true,
        'message' => 'Schedule of Supports activity logs fetched successfully.',
        'data'    => $response,
    ]);
}

public function getLogsByUuidHomeSafety(Request $request)
{
    $uuid  = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    // 1️⃣ Validate UUID
    $record = \App\Models\HomeSafetyChecklistAssessment::where('uuid', $uuid)->first();

    if (!$record) {
        return response()->json([
            'status'  => false,
            'message' => 'Invalid UUID. No Home Safety Checklist Assessment found.',
        ], 404);
    }

    // 2️⃣ Build activity log query
    $query = \Spatie\Activitylog\Models\Activity::where('properties->home_safety_checklist_assessment_id', $record->id);

    // Optional table filter (log_name)
    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        $query->whereIn('log_name', [
            'home_safety_checklist_assessment',
            'home_safety_outside_entry',
            'home_safety_inside_residence',
            'hallways_safety_check',
            'kitchen_bathroom_safety_check',
            'outside_residence_assessment',
            'home_safety_miscellaneous',
            'home_safety_residence_type'
        ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // 3️⃣ Extract staff IDs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();
    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);
    $staffNames = $staffRecords->pluck('name', 'id')->toArray();

    // 4️⃣ Resolve stafftype names
    $stafftypeIdsFromStaff = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();
    $stafftypeIdsFromLogs  = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();
    $stafftypeIds = collect($stafftypeIdsFromLogs)->merge($stafftypeIdsFromStaff)->unique()->toArray();

    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int) $id => $name])
        ->toArray();

    // 5️⃣ Optional filter by field
    if (!empty($field) && $field !== 'all') {
        $logs = $logs->filter(function ($log) use ($field) {
            $properties = $log->properties ?? [];
            $attributes = $properties['attributes'] ?? [];
            $old = $properties['old'] ?? [];

            return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
        })->values();
    }

    // 6️⃣ Format response
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old = $properties['old'] ?? [];

        $formattedAttributes = collect($attributes)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));
       $formattedOld = collect($old)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));

        $staffId = $properties['staff_id'] ?? null;
        $stafftypeId = $properties['stafftype'] ?? null;

        if (!$stafftypeId && $staffId) {
            $staff = \App\Models\Staff::find($staffId);
            $stafftypeId = $staff?->stafftype;
        }

        return [
            'id'             => $log->id,
            'log_name'       => $log->log_name,
            'description'    => $log->description,
            'created_at'     => $log->created_at->toDateTimeString(),
            'attributes'     => $formattedAttributes,
            'old'            => $formattedOld,
            'user_id'        => $properties['user_id'] ?? null,
            'client_type'    => $properties['client_type'] ?? null,
            'stafftype_id'   => $stafftypeId,
            'stafftype_name' => $stafftypenames[(int) $stafftypeId] ?? null,
            'staff_id'       => $staffId,
            'staff_name'     => $staffNames[$staffId] ?? null,
            'uuid'           => $properties['uuid'] ?? null,
        ];
    });

    // 7️⃣ Return response
    return response()->json([
        'status'  => true,
        'message' => 'Home Safety Checklist Assessment activity logs fetched successfully.',
        'data'    => $response,
    ]);
}


public function getLogsByUuidConfidential(Request $request)
{
    $uuid  = $request->query('uuid');
    $table = $request->query('table');
    $field = $request->query('field');

    // 1️⃣ Validate UUID
    $record = \App\Models\ConfidentialInformationForm::where('uuid', $uuid)->first();

    if (!$record) {
        return response()->json([
            'status'  => false,
            'message' => 'Invalid UUID. No Confidential Information Form found.',
        ], 404);
    }

    // 2️⃣ Build activity log query
    $query = \Spatie\Activitylog\Models\Activity::where('properties->confidential_information_form_id', $record->id);

    if (!empty($table)) {
        $query->where('log_name', $table);
    } else {
        $query->whereIn('log_name', [
            'confidential_information_form',
            'confidential_information_agency'
            // Add more log_names if needed
        ]);
    }

    $logs = $query->orderBy('created_at', 'desc')->get();

    // 3️⃣ Extract staff IDs
    $staffIds = $logs->pluck('properties.staff_id')->filter()->unique()->toArray();
    $staffRecords = \App\Models\Staff::whereIn('id', $staffIds)->get(['id', 'name', 'stafftype']);
    $staffNames = $staffRecords->pluck('name', 'id')->toArray();

    // 4️⃣ Resolve stafftype names
    $stafftypeIdsFromStaff = $staffRecords->pluck('stafftype')->filter()->unique()->toArray();
    $stafftypeIdsFromLogs  = $logs->pluck('properties.stafftype')->filter()->unique()->toArray();
    $stafftypeIds = collect($stafftypeIdsFromLogs)->merge($stafftypeIdsFromStaff)->unique()->toArray();

    $stafftypenames = \App\Models\StaffTypeMaster::whereIn('id', $stafftypeIds)
        ->pluck('name', 'id')
        ->mapWithKeys(fn($name, $id) => [(int) $id => $name])
        ->toArray();

    // 5️⃣ Optional filter by field
    if (!empty($field) && $field !== 'all') {
        $logs = $logs->filter(function ($log) use ($field) {
            $properties = $log->properties ?? [];
            $attributes = $properties['attributes'] ?? [];
            $old = $properties['old'] ?? [];

            return isset($attributes[$field]) || isset($old[$field]) || isset($properties[$field]);
        })->values();
    }

    // 6️⃣ Format response
    $response = $logs->map(function ($log) use ($staffNames, $stafftypenames) {
        $properties = $log->properties ?? [];
        $attributes = $properties['attributes'] ?? [];
        $old = $properties['old'] ?? [];

        $formattedAttributes = collect($attributes)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));
        $formattedOld = collect($old)->map(fn($val) => ($val === true || $val === 1 || $val === '1') ? 'Yes' : (($val === false || $val === 0 || $val === '0') ? 'No' : $val));

        $staffId = $properties['staff_id'] ?? null;
        $stafftypeId = $properties['stafftype'] ?? null;

        if (!$stafftypeId && $staffId) {
            $staff = \App\Models\Staff::find($staffId);
            $stafftypeId = $staff?->stafftype;
        }

        return [
            'id'             => $log->id,
            'log_name'       => $log->log_name,
            'description'    => $log->description,
            'created_at'     => $log->created_at->toDateTimeString(),
            'attributes'     => $formattedAttributes,
            'old'            => $formattedOld,
            'user_id'        => $properties['user_id'] ?? null,
            'client_type'    => $properties['client_type'] ?? null,
            'stafftype_id'   => $stafftypeId,
            'stafftype_name' => $stafftypenames[(int) $stafftypeId] ?? null,
            'staff_id'       => $staffId,
            'staff_name'     => $staffNames[$staffId] ?? null,
            'uuid'           => $properties['uuid'] ?? null,
        ];
    });

    // 7️⃣ Return response
    return response()->json([
        'status'  => true,
        'message' => 'Confidential Information Form activity logs fetched successfully.',
        'data'    => $response,
    ]);
}


}
