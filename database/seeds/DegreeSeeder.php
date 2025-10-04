<?php

use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    public function run()
    {
        // Seed only in local to avoid polluting other environments
        if (!app()->environment('local', 'development')) {
            $this->command->warn('DegreeSeeder skipped (env not local/development).');
            return;
        }

        $degrees = [
            ['name' => 'BSCS', 'display_name' => 'BS Computer Science'],
            ['name' => 'BSIT', 'display_name' => 'BS Information Technology'],
            ['name' => 'BSIS', 'display_name' => 'BS Information Systems'],
            ['name' => 'BSHRM', 'display_name' => 'BS Hotel & Restaurant Management'],
            ['name' => 'BSTM', 'display_name' => 'BS Tourism Management'],
            ['name' => 'BSA', 'display_name' => 'BS Accountancy'],
            ['name' => 'BSE', 'display_name' => 'BS Engineering'],
            ['name' => 'others', 'display_name' => 'Other Degree'],
        ];

        foreach ($degrees as $deg) {
            \App\Degree::firstOrCreate(['name' => $deg['name']], $deg);
        }

        $this->command->info('DegreeSeeder completed for local environment.');
    }
}
