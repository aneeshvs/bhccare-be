<?php
namespace App\Http\Controllers\Api;
 use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\InitialEnquiry;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

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

    // Fallback from InitialEnquiry table
    $initial = InitialEnquiry::where('uuid', $uuid)->first();

    if (!$initial) {
        return response()->json(['message' => 'Invalid UUID. No InitialEnquiry found.'], 404);
    }

    // Use initial_enquiry_id (not user_id) for accuracy
    $logs = Activity::whereIn('log_name', [
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
        ])
        ->where('properties->initial_enquiry_id', $initial->id)
        ->orderBy('created_at', 'desc')
        ->get();

    $response = $logs->map(function ($log) {
        return [
            'id' => $log->id,
            'log_name' => $log->log_name,
            'description' => $log->description,
            'created_at' => $log->created_at->toDateTimeString(),
            'attributes' => $log->properties['attributes'] ?? [],
            'old' => $log->properties['old'] ?? [],
            'user_id' => $log->properties['user_id'] ?? null,
            'client_type' => $log->properties['client_type'] ?? null,
            'staff_id' => $log->properties['staff_id'] ?? null,
            'uuid' => $log->properties['uuid'] ?? null,
        ];
    });

    return response()->json([
        'status' => true,
        'message' => 'Activity logs fetched successfully.',
        'data' => $response,
    ]);
}
}
