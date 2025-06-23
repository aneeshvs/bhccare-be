<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_types')->insert([
            ['id' => 1, 'name' => 'Admin','status_id' =>'1', 'uuid'=>Str::uuid()],
            ['id' => 2, 'name' => 'Prompt','status_id' =>'1', 'uuid'=>Str::uuid()],
            ['id' => 3, 'name' => 'User','status_id' =>'1', 'uuid'=>Str::uuid()],
        ]);
    }
}
