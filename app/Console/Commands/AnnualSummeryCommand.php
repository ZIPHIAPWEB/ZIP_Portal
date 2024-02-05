<?php

namespace App\Console\Commands;

use App\Program;
use App\Student;
use App\Summary;
use Illuminate\Console\Command;

class AnnualSummeryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AnnualSummaryEntry:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save the annual summary in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $programs = array('All', 'Summer Work and Travel - Summer', 'Summer Work and Travel - Spring', 'Internship', 'Career Training');

        foreach ($programs as $program) {
            Summary::create([
                'year'               =>  date('Y-m-d'),
                'program'            =>  $program,
                'total'              =>  ($program == 'All') ? Student::count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->count(),
                'new_applicant'      =>  ($program == 'All') ? Student::where('application_status', 'New Applicant')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'New Applicant')->count(),
                'assessed'           =>  ($program == 'All') ? Student::where('application_status', 'Assessed')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'Assessed')->count(),
                'confirmed'          =>  ($program == 'All') ? Student::where('application_status', 'Confirmed')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'Confirmed')->count(),
                'hired'              =>  ($program == 'All') ? Student::where('application_status', 'Hired')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'Hired')->count(),
                'for_visa_interview' =>  ($program == 'All') ? Student::where('application_status', 'For Visa Interview')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'For Visa Interview')->count(),
                'visa_approved'      =>  ($program == 'All') ? Student::where('application_status', 'Approved')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'Approved')->count(),
                'visa_denied'        =>  ($program == 'All') ? Student::where('application_status', 'Denied')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'Denied')->count(),
                'cancel'             =>  ($program == 'All') ? Student::where('application_status', 'Cancelled')->count() : Student::where('program_id', Program::where('display_name', $program)->first()->id)->where('application_status', 'Cancelled')->count(),
            ]);
        }
    }
}
