<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BhcServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Community Access',
            'Home Care',
            'Day Program',
            'SIL / Respite / SDA / STA / MTA',
            'Household Cleaning and Maintaining',
        ];

        foreach ($services as $service) {
            DB::table('bhc_services')->insert([
                'service_name' => $service,
                'uuid'=>Str::uuid()

            ]);
        }
    }
}
