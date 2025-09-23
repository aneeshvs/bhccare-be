<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $admin = User::create([
            'name'         => 'Admin',
            'email'        => 'admin@bestofhomecare.com.au',
            'password'     => Hash::make('24brownsrdDM'),
            'user_type_id'  => 1, // Admin
        ]);
    }
}
