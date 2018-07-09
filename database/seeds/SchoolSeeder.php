<?php

use Illuminate\Database\Seeder;
use App\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = new School();

        $school->name = 'Sample School #1';
        $school->display_name = 'Sample Display Name #1';
        $school->description = 'Sample Description #1';

        $school->save();

        $school = new School();

        $school->name = 'Sample School #2';
        $school->display_name = 'Sample Display Name #2';
        $school->description = 'Sample Description #2';

        $school->save();

        $school = new School();

        $school->name = 'Sample School #3';
        $school->display_name = 'Sample Display Name #3';
        $school->description = 'Sample Description #3';

        $school->save();

        $school = new School();

        $school->name = 'Sample School #4';
        $school->display_name = 'Sample Display Name #4';
        $school->description = 'Sample Description #4';

        $school->save();
    }
}
