<?php

namespace App\Http\Controllers\v2;

use App\Actions\ConvertProgramToIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoordStudentResource;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoordController extends Controller
{
    public function getStudents(Request $request)
    {
        $query = Student::query();

        $query->when($request->input('program') !== null, function ($q) use ($request) {

            return $q->where('program_id', (new ConvertProgramToIdAction)->execute($request->input('program')));
        });

        $query->when($request->input('from_date') !== null, function ($q) use ($request) {

            return $q->whereBetween('created_at', [$request->input('from_date'), $request->input('to_date') ?? Carbon::now()->toDateString()]);
        });

        $query->when($request->input('status') !== null, function ($q) use ($request) {

            return $q->where('application_status', $request->input('status'));
        });

        $students = $query->paginate(1);

        return CoordStudentResource::collection($students);
    }
}
