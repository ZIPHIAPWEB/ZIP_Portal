<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentFlightDetailsResource;
use App\Http\Resources\StudentPdosCfoScheduleResource;
use App\Http\Resources\StudentVIsaInterviewResource;
use App\Http\Resources\StudentVisaSponsorResource;

class StudentProgramInfoController extends Controller
{
    public function getVisaSponsor()
    {
        $student = auth()->user()->student()->first();

        return new StudentVisaSponsorResource($student);
    }

    public function getVisaInterviewDetails()
    {
        $student = auth()->user()->student()->first();

        return new StudentVIsaInterviewResource($student);
    }

    public function getPdosCfoSchedule()
    {
        $student = auth()->user()->student()->first();

        return new StudentPdosCfoScheduleResource($student);
    }

    public function getFlightDetails()
    {
        $student = auth()->user()->student()->first();

        return new StudentFlightDetailsResource($student);
    }
}
