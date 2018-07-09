<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsor = new Sponsor();

        $sponsor->name = 'AAG';
        $sponsor->display_name = 'AAG';
        $sponsor->description = 'AAG';

        $sponsor->save();

        $sponsor = new Sponsor();

        $sponsor->name = 'ICEO';
        $sponsor->display_name = 'ICEO';
        $sponsor->description = 'ICEO';

        $sponsor->save();
    }
}
