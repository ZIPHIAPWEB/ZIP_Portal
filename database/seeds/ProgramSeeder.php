<?php

use Illuminate\Database\Seeder;
use App\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program = new Program();

        $program->name = 'SWT - Spring';
        $program->display_name = 'Summer Work and Travel - Spring';
        $program->description = 'SWT-SP';

        $program->save();

        $program = new Program();

        $program->name = 'Internship';
        $program->display_name = 'Internship';
        $program->description = 'INT';

        $program->save();

        $program = new Program();

        $program->name = 'Career Training';
        $program->display_name = 'Career Training';
        $program->description = 'CTP';

        $program->save();

        $program = new Program();

        $program->name = 'SWT - Summer';
        $program->display_name = 'Summer Work and Travel - Summer';
        $program->description = 'SWT-SM';

        $program->save();
    }
}
