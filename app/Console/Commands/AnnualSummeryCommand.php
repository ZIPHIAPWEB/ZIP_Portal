<?php

namespace App\Console\Commands;

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
        $year   = date('Y');
        $labels  = ['New Applicant', 'Assessed', 'Confirmed', 'Hired', 'For Visa Interview', 'Approved', 'Denied'];

        foreach ($labels as $label) {
            Summary::create([
                'year'      =>  $year,
                'label'     =>  $label,
                'value'     =>  Student::where('application_status', $label)->count(),
                'program'   =>  ''
            ]);
        }
    }
}
