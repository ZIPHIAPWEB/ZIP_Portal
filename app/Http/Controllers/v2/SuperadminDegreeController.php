<?php

namespace App\Http\Controllers\v2;

use App\Degree;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperadminDegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $degrees = Degree::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Degrees successfully loaded',
            'data' => $degrees
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
        $createdDegree = Degree::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Degrees successfully created',
            'data' => $createdDegree
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function show(Degree $degree)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Degrees successfully loaded',
            'data' => $degree
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Degree $degree)
    {
        $degree->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        $degree->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Degrees successfully updated',
            'data' => $degree
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Degrees successfully deleted',
            'data' => $degree
        ], Response::HTTP_OK);
    }
}
