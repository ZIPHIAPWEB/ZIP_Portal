<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(HostCompanySeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(SchoolSeeder::class);
    }
}
