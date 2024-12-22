<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolCreateUpdateRequest;
use App\Http\Resources\SuperadminSchoolResource;
use App\School;
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

        return SuperadminSchoolResource::collection($schools);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolCreateUpdateRequest $request)
    {
        $createdSchool = School::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'School successfully created',
            'data' => new SuperadminSchoolResource($createdSchool)
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
            'data' => new SuperadminSchoolResource($school)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolCreateUpdateRequest $request, School $school)
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
            'data' => new SuperadminSchoolResource($school)
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
        if (!$school->exists()) {

            abort('404', 'School not found.');
        }

        $school->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'School successfully deleted',
        ], Response::HTTP_OK);
    }
}
