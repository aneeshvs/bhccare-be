<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Classes\UniversalController;
use App\Models\User; // assuming staff is stored in the users table
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;

class StaffSyncController extends UniversalController
{


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'phone' => 'nullable|string',
        'username' => 'nullable|string',
        'stafftype' => 'nullable|string',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'usertype' => 'staff',
    ]);

    // ✅ Store in staff table too
    $staff = Staff::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'username' => $request->username,
        'stafftype' => $request->stafftype,
        'user_id' => $user->id,

    ]);

    return response()->json([
        'status' => true,
        'user' => $user,
        'staff' => $staff,
    ]);
}

   // Laravel: StaffSyncController.php
    // In StaffSyncController
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully in Laravel backend.'
        ]);
    }



}
