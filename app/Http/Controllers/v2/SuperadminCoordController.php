<?php

namespace App\Http\Controllers\v2;

use App\Coordinator;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuperadminCoordResource;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperadminCoordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isSearch = $request->has('search');

        $query = User::query()
            ->whereHas('roles', function ($q) {

                $q->where('name', 'coordinator');
            });

        $query->when($isSearch && $request->input('search') !== null, function ($q) use ($request) {

            return $q->where('name', 'like', '%'.$request->input('search').'%');
        });

        $coords = $query->orderBy('created_at', 'desc')->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Coordinator successfully loaded',
            'data' => SuperadminCoordResource::collection($coords)
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
        $createdUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'vToken' => null,
            'verified' => 1,
            'isFilled' => 0
        ]);

        if (!$createdUser) {

            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Unable to create a coordinator'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $coordinatorRole = Role::query()->where('name', 'coordinator')->first();

        $createdUser->roles()->attach($coordinatorRole->id, ['user_type' => 'App/User']);

        $createdUser->coordinator()->create([
            'firstName' => $request->input('first_name'),
            'middleName' => $request->input('middle_name') ?? '',
            'lastName' => $request->input('last_name'),
            'program' => $request->input('program'),
            'position' => $request->input('position'),
            'contact' => $request->input('contact')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Coordinator successfully created',
            'data' => new SuperadminCoordResource($createdUser)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinator $coordinator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coordinator $coordinator)
    {
        $coordinator->update([
            'firstName' => $request->input('first_name'),
            'middleName' => $request->input('middle_name') ?? '',
            'lastName' => $request->input('last_name'),
            'program' => $request->input('program'),
            'position' => $request->input('position'),
            'contact' => $request->input('contact')
        ]);

        $coordinator->user()->update([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Coordinator successfully updated'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinator $coordinator)
    {
        $coordinator->delete();

        $coordinator->user()->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Coordinator successfully deleted'
        ], Response::HTTP_OK);
    }
}
