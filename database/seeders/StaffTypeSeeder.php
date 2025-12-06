<?php
// database/seeders/StaffTypeSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class StaffTypeSeeder extends Seeder
{
    public function run(): void
    {
        $staffTypes = [
            11 => 'Support Worker',
            12 => 'Digital Designer',
            13 => 'Support Coordinator',
            14 => 'Rostering',
            15 => 'Finance',
            16 => 'Admin',
            17 => 'Driver',
            18 => 'Gardner',
            19 => 'SIL Coordinator',
            20 => 'HR',
            21 => 'Director',
            22 => 'Senior Support Worker',
            23 => 'Task Manager',
            24 => 'NDIS Day Program Coordinator',
            25 => 'Registered Nurse',
            26 => 'Intake and Service Delivery Officer',
            27 => 'Cleaner',
            28 => 'Maintenance and Service Technician',
            29 => 'Primary Health Organisation Manager',
            30 => 'Service Delivery Coordinator',
            31 => 'Test',
            32 => 'Candidate',
            33 => 'Service Manager',
            35 => 'SIL Coordinator Team Leader',
            36 => 'Case Manager (HCP)',
        ];

        foreach ($staffTypes as $id => $name) {
            DB::table('staff_type_master')->insert([
                'id' => $id,
                'name' => $name,
                'uuid'=>Str::uuid()
            ]);
        }
    }
}
