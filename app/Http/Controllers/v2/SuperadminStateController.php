<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateCreateUpdateRequest;
use App\State;
use Illuminate\Http\Response;

class SuperadminStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'States successfully loaded',
            'data' => $states
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateCreateUpdateRequest $request)
    {
        $createdState = State::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'State successfully created',
            'data' => $createdState
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'States successfully loaded',
            'data' => $state
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateCreateUpdateRequest $request, State $state)
    {
        $state->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        $state->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'State successfully loaded',
            'data' => $state
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'State successfully deleted',
        ], Response::HTTP_OK);
    }
}
