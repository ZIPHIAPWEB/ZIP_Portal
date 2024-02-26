<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuperadminVisaSponsorResource;
use App\Sponsor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperadminSponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return SuperadminVisaSponsorResource::collection($sponsors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createdSponsor = Sponsor::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Visa sponsor successfully created',
            'data' => new SuperadminVisaSponsorResource($createdSponsor)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Visa sponsor successfully loaded',
            'data' => new SuperadminVisaSponsorResource($sponsor)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $sponsor->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        $sponsor->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Visa sponsor successfully updated',
            'data' => new SuperadminVisaSponsorResource($sponsor)
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        if (!$sponsor->exists()) {

            abort(404, 'Sponsor not found.');
        }

        $sponsor->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Visa sponsor successfully deleted',
        ], Response::HTTP_OK);
    }
}
