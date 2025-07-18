<?php
namespace App\Http\Controllers\Api;
 use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

    // 1️⃣ Get the first activity by UUID to extract client ID
    $firstLog = Activity::where('properties->uuid', $uuid)->first();

    if (!$firstLog) {
        return response()->json(['message' => 'No activity log found for the given UUID.'], 404);
    }

    $clientId = $firstLog->properties['user_id'] ?? null;

    if (!$clientId) {
        return response()->json(['message' => 'Client ID not found in activity log.'], 404);
    }

    // 2️⃣ Fetch all logs for this client
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
        ->where('properties->user_id', $clientId)
        ->orderBy('created_at', 'desc')
        ->get();

    // 3️⃣ Return raw log + parsed properties
    $response = $logs->map(function ($log) {
        return [
            'id' => $log->id,
            'log_name' => $log->log_name,
            'description' => $log->description,
            'created_at' => $log->created_at->toDateTimeString(),
            'attributes' => $log->properties['attributes'] ?? [],
            'old' => $log->properties['old'] ?? [],
            'user_id' => $log->properties['user_id'] ?? $log->properties['attributes']['user_id'] ?? null,
            'client_type' => $log->properties['client_type'] ?? $log->properties['attributes']['client_type'] ?? null,
            'staff_id' => $log->properties['staff_id'] ?? $log->properties['attributes']['staff_id'] ?? null,
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
