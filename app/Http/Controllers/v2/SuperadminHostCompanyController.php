<?php

namespace App\Http\Controllers\v2;

use App\HostCompany;
use App\Http\Controllers\Controller;
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

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Host companies successfully loaded',
            'data' => $hostCompanies
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
        $createdHostCompany = HostCompany::create([
            'name' => $request->input('name'),
            'state' => $request->input('state')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Host company successfully created',
            'data' => $createdHostCompany
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
            'data' => $hostCompany
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
            'state' => $request->input('state')
        ]);

        $hostCompany->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Host company successfully loaded',
            'data' => $hostCompany
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
        $hostCompany->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Host company successfully deleted',
        ], Response::HTTP_OK);
    }
}
