<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramCreateUpdateRequest;
use App\Http\Resources\SuperadminProgramResource;
use App\Program;
use Illuminate\Http\Response;

class SuperadminProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return SuperadminProgramResource::collection($programs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramCreateUpdateRequest $request)
    {
        $createdProgram = Program::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Program successfully created',
            'data' => $createdProgram
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Program $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Program successfully loaded',
            'data' => $program
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Program $program
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramCreateUpdateRequest $request, Program $program)
    {

        $program->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        $program->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Program successfully updated',
            'data' => $program
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Program $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Program successfully deleted'
        ], Response::HTTP_OK);
    }
}
