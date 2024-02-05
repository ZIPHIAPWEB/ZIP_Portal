<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperadminSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Schools successfully loaded.',
            'data' => $schools
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createdSchool = School::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'School successfully created',
            'data' => $createdSchool
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'School successfully loaded.',
            'data' => $school
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $school->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        $school->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'School successfully updated',
            'data' => $school
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'School successfully deleted',
        ], Response::HTTP_OK);
    }
}
