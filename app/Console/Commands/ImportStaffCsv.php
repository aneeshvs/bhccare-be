<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ImportStaffCsv extends Command
{
    protected $signature = 'staff:import-csv {file}';
    protected $description = 'Import staff from CSV';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return;
        }

        $rows = array_map('str_getcsv', file($file));
        $header = array_map('trim', array_shift($rows));

        foreach ($rows as $row) {
            if (empty(array_filter($row))) continue; // Skip empty rows

            if (count($row) != count($header)) {
                $this->warn('Skipping row: column count mismatch');
                continue;
            }

            $data = array_combine($header, $row);

            // Required fields
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                $this->warn('Skipping row: missing required fields');
                continue;
            }

            // Map stafftype name to ID
            $stafftypeId = null;
            if (!empty($data['stafftype'])) {
                $record = DB::table('staff_type_master')->where('name', $data['stafftype'])->first();
                $stafftypeId = $record->id ?? null;
            }

            // Create user
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make($data['password']),
                    'usertype' => 'staff',
                ]
            );

            // Create staff
            $staff = Staff::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'      => $data['name'],
                    'user_id'   => $user->id,
                    'phone'     => $data['phone'] ?? null,
                    'username'  => $data['username'] ?? null,
                    'stafftype' => $stafftypeId,
                ]
            );

            $this->info("Imported staff: {$staff->name} <{$staff->email}>");
        }
    }
}
