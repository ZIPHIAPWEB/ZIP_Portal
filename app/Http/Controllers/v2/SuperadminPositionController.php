<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperadminPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Positions successfully loaded',
            'data' => $positions
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
        $createdPosition = Position::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Positions successfully created',
            'data' => $createdPosition
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Position successfully loaded',
            'data' => $position
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $position->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        $position->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Position successfully updated',
            'data' => $position
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Position successfully deleted',
        ], Response::HTTP_OK);
    }
}
