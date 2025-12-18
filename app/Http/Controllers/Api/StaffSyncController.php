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
        'name'      => 'required|string',
        'email'     => 'required|email',
        'password'  => 'required|string',
        'phone'     => 'nullable|string',
        'username'  => 'nullable|string',
        'stafftype' => 'nullable|string',
    ]);

    // 🔹 Check if user already exists
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // ✅ Update existing user & staff
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,   // update email too
            'password' => Hash::make($request->password),
        ]);

        $staff = Staff::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'username'  => $request->username,
                'stafftype' => $request->stafftype,
            ]
        );
    } else {
        // ✅ Create new user & staff
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => 3,
        ]);

        $staff = Staff::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'username'  => $request->username,
            'stafftype' => $request->stafftype,
            'user_id'   => $user->id,
        ]);
    }

    return response()->json([
        'status' => true,
        'message'=> $user->wasRecentlyCreated ? 'Staff created successfully' : 'Staff updated successfully',
        'user'   => $user,
        'staff'  => $staff,
    ]);
}



   // Laravel: StaffSyncController.php
    // In StaffSyncController
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
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
