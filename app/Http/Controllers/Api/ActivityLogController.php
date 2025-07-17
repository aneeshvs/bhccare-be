<?php
namespace App\Http\Controllers\Api;
 use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


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


public function exportLogsPdf(Request $request)
{
    $uuid = $request->query('uuid');

    if (!$uuid) {
        return response()->json(['status' => false, 'message' => 'UUID is required'], 422);
    }

    $logs = Activity::whereJsonContains('properties->uuid', $uuid)
                    ->latest()
                    ->take(100)
                    ->get();

    $pdf = Pdf::loadView('logs.pdf', compact('logs', 'uuid'));

    return $pdf->download("activity-logs-$uuid.pdf");
}

}
