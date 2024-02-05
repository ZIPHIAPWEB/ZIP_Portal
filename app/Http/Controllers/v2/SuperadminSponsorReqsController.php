<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\SponsorRequirement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SuperadminSponsorReqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reqs = SponsorRequirement::query()
            ->orderBy('created_at', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Sponsor requirements successfully loaded',
            'data' => $reqs
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
        $createdReqs = SponsorRequirement::create([
            'sponsor_id' => $request->input('sponsor_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'path' => $request->hasFile('file') ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Sponsosr requirement successfully created',
            'data' => $createdReqs
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SponsorRequirement  $sponsorRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(SponsorRequirement $sponsorRequirement)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Sponsor requirement successfully loaded',
            'data' => $sponsorRequirement
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SponsorRequirement  $sponsorRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SponsorRequirement $sponsorRequirement)
    {
        if (!($sponsorRequirement->path == '' || $sponsorRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($sponsorRequirement->path);
        }

        $sponsorRequirement->update([
            'sponsor_id' => $request->input('sponsor_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'path' => ($request->hasFile('file')) ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        $sponsorRequirement->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Sponsor requirement successfully updated',
            'data' => $sponsorRequirement
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SponsorRequirement  $sponsorRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(SponsorRequirement $sponsorRequirement)
    {
        if (!($sponsorRequirement->path == '' || $sponsorRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($sponsorRequirement->path);
        }

        $sponsorRequirement->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Sponsor requirement successfully deleted'
        ], Response::HTTP_OK);
    }
}
