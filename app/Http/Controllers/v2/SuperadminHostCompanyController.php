<?php

namespace App\Http\Controllers\v2;

use App\HostCompany;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuperadminHostCompanyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperadminHostCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostCompanies = HostCompany::query()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return SuperadminHostCompanyResource::collection($hostCompanies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createdHostCompany = HostCompany::create([
            'name' => $request->input('name'),
            'state' => $request->input('description')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Host company successfully created',
            'data' => new SuperadminHostCompanyResource($createdHostCompany)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HostCompany  $hostCompany
     * @return \Illuminate\Http\Response
     */
    public function show(HostCompany $hostCompany)
    {

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Host company successfully loaded',
            'data' => new SuperadminHostCompanyResource($hostCompany)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HostCompany  $hostCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HostCompany $hostCompany)
    {
        $hostCompany->update([
            'name' => $request->input('name'),
            'state' => $request->input('description')
        ]);

        $hostCompany->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Host company successfully loaded',
            'data' => new SuperadminHostCompanyResource($hostCompany)
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HostCompany  $hostCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(HostCompany $hostCompany)
    {
        if ($hostCompany->exists()) {

            abort(404, 'Host company not found.');
        }

        $hostCompany->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Host company successfully deleted',
        ], Response::HTTP_OK);
    }
}
