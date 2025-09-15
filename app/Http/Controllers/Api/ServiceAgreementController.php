<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceAgreement;
use App\ServiceAgreementService\ServiceAgreementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceAgreementController extends Controller
{
    public function update(Request $request, ServiceAgreementService $service)
    {
        $data = $request->all();
        $isFinal = $request->boolean('submit_final');
        $data['form_status'] = $isFinal ? 'completed' : 'in_progress';

        $result = DB::transaction(function () use ($data, $service) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $staff = \App\Models\Staff::where('user_id', $user->id)->first();
            $data['staff_id'] = $staff?->id ?? null;

            $agreement = $service->save($data);

            if ($data['form_status'] === 'completed') {
                $agreement->form_status = 'completed';
                $agreement->save();
            }

            return $agreement;
        });

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Service Agreement saved successfully.',
            'data' => $result,
        ]);
    }
}
