<?php
// app/Http/Controllers/Api/LeadController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Client;

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

            'status'     => true,
            'message'    => 'Lead created successfully',
            'uuid'       => $lead->uuid,
            'form_link'  => url("/form/submit/{$lead->uuid}"),
        ]);
    }
        public function show(string $uuid)
    {
        $lead = \App\Models\Lead::where('uuid', $uuid)->firstOrFail();


        if ($lead->form_status === 'completed') {
            return response()->json([
                'status' => false,
                'message' => 'This form has already been submitted.',
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'full_name' => $lead->full_name,
                'email'     => $lead->email,
                'mobile'    => $lead->mobile,
            ],
        ]);
    }
            public function showFullDetails(string $uuid)
        {
            $lead = Lead::where('uuid', $uuid)->firstOrFail();

            if ($lead->form_status !== 'completed') {
                return response()->json([
                    'status' => false,
                    'message' => 'Form has not been completed by client.',
                ], 404);
            }

            $client = Client::with([
                'referrals',
                'accommodations',
                'selectedServices',
                'previousServiceProviders',
                'clientNdisDetail',
                'medicalInformation',
                'housingHistory',
                'rosterOfCare',
                'ndisGoals',
                'independentLivingOption',
                'finalDeclaration'
            ])->where('lead_id', $lead->id)->first();

            if (!$client) {
                return response()->json([
                    'status' => false,
                    'message' => 'Client form not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $client
            ]);
        }



}
