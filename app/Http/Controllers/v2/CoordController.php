<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class CoordController extends Controller
{
    public function getStudents(Request $request)
    {
        $query = Student::query();

        $query->when(isset($request->input('from_date')), function ($q) use ($request) {

            return $q->whereBetween('created_at', [$request->input('from_date'), $request->input('to_date')]);
        });

        $query->when(isset($request->input('status')), function ($q) use ($request) {

            return $q->where('status', $request->input('status'));
        });

        $students = $query->get();

        return response()->json([
            'data' => $students
        ], 200);
    }

    public function showStudent()
    {
        
    }
}
