<?php

use Illuminate\Database\Seeder;
use App\Program;
use App\ProgramCategory;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programCategories = [
            'US Programs',
            'Canada Programs',
        ];

        ProgramCategory::truncate();
        foreach ($programCategories as $category) {
            \App\ProgramCategory::firstOrCreate(['name' => $category, 'display_name' => $category, 'description' => $category]);
        }

        $programs = [
            [
            'name' => 'SWT - Spring',
            'display_name' => 'Summer Work and Travel - Spring',
            'description' => 'SWT-SP',
            ],
            [
            'name' => 'Internship',
            'display_name' => 'Internship',
            'description' => 'INT',
            ],
            [
            'name' => 'Career Training',
            'display_name' => 'Career Training',
            'description' => 'CTP',
            ],
            [
            'name' => 'SWT - Summer',
            'display_name' => 'Summer Work and Travel - Summer',
            'description' => 'SWT-SM',
            ],
        ];

        Program::truncate();

        foreach ($programs as $programData) {
            $program = Program::create($programData);

            $program->programCategory()->associate(1);
            $program->save();
        }
    }
}
