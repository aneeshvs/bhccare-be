<?php
// app/Http/Controllers/Api/LeadController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends UniversalController
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:20',
        ]);

        $lead = Lead::create($validated);

        return response()->json([
            'result'    => $lead,
            'status'     => true,
            'message'    => 'Lead created successfully',
            'uuid'       => $lead->uuid,
            'form_link'  => url("/form/submit/{$lead->uuid}"),
        ]);
    }
}
