<?php

use Illuminate\Database\Seeder;
use App\HostCompany;

class HostCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $host_company = new HostCompany();

        $host_company->name = 'Sample Company #1';
        $host_company->states = 'Sample State #1';
        $host_company->save();

        $host_company = new HostCompany();

        $host_company->name = 'Sample Company #2';
        $host_company->states = 'Sample State #2';
        $host_company->save();
    }
}
