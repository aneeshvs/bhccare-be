<?php
namespace App\Http\Controllers;

use App\Models\Chargeband;
use App\Http\Requests\StoreChargebandRequest;

class ChargebandController extends Controller
{
    // INDEX — list all chargebands
    public function index()
    {
        $chargebands = Chargeband::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $chargebands
        ]);
    }

    // STORE — add new chargeband
    public function store(StoreChargebandRequest $request)
    {
        $chargeband = Chargeband::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Chargeband created successfully',
            'data' => $chargeband
        ]);
    }
}
