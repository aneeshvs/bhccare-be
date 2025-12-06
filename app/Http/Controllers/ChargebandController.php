<?php

namespace App\Http\Controllers;

use App\Models\Chargeband;
use Illuminate\Http\Request;

class ChargebandController extends Controller
{
    // GET /chargebands
    public function index()
    {
        $data = Chargeband::orderBy('id', 'desc')->get();
        

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // POST /chargebands
    public function store(Request $request)
    {
        $chargeband = Chargeband::create([
            'chargeband_name' => $request->chargeband_name,
            // 'categoryid'      => $request->categoryid,
            // 'fundtypeid'      => $request->fundtypeid,
            // 'serviceid'       => $request->serviceid,
            // 'color'           => $request->color,
            // 'status'          => $request->status,
            // 'companyid'       => $request->companyid,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Chargeband created successfully',
            'data' => $chargeband
        ], 201);
    }

    // GET /chargebands/{uuid}
    public function show($uuid)
    {
        $chargeband = Chargeband::where('uuid', $uuid)->firstOrFail();

        return response()->json([
            'status' => true,
            'data' => $chargeband
        ]);
    }

    // PUT/PATCH /chargebands/{uuid}
    public function update(Request $request, $uuid)
    {
        $chargeband = Chargeband::where('uuid', $uuid)->firstOrFail();

        $chargeband->update([
            'chargeband_name' => $request->chargeband_name ?? $chargeband->chargeband_name,
            'categoryid'      => $request->categoryid ?? $chargeband->categoryid,
            'fundtypeid'      => $request->fundtypeid ?? $chargeband->fundtypeid,
            'serviceid'       => $request->serviceid ?? $chargeband->serviceid,
            'color'           => $request->color ?? $chargeband->color,
            'status'          => $request->status ?? $chargeband->status,
            'companyid'       => $request->companyid ?? $chargeband->companyid,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Chargeband updated successfully',
            'data' => $chargeband
        ]);
    }
    
    // DELETE /chargebands/{uuid}
    public function destroy($uuid)
    {
        $chargeband = Chargeband::where('uuid', $uuid)->firstOrFail();
        $chargeband->delete();

        return response()->json([
            'status' => true,
            'message' => 'Chargeband deleted successfully'
        ]);
    }
}
