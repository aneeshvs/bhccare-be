<?php
namespace App\Http\Controllers\Api;

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
}
