<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuperadminSponsorRequirementResource;
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

        return SuperadminSponsorRequirementResource::collection($reqs);
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
            'is_active' => $request->input('is_active') == 'true' ? 1 : 0
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Sponsosr requirement successfully created',
            'data' => new SuperadminSponsorRequirementResource($createdReqs)
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
            'data' => new SuperadminSponsorRequirementResource($sponsorRequirement)
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
        $sponsorRequirement->update([
            'sponsor_id' => $request->input('sponsor_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active') == 'true' ? 1 : 0
        ]);

        $sponsorRequirement->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Sponsor requirement successfully updated',
            'data' => new SuperadminSponsorRequirementResource($sponsorRequirement)
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

    public function uploadSponsorFile(Request $request, SponsorRequirement $sponsorRequirement)
    {
        if(!$sponsorRequirement->exists()) {

            abort(404, 'Sponsor requirement not found.');
        }

        if (!($sponsorRequirement->path == '' || $sponsorRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($sponsorRequirement->path);
        }

        $sponsorRequirement->update([
            'path' => ($request->hasFile('file')) ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        return response()->noContent();
    }

    public function removeSponsorFile(SponsorRequirement $sponsorRequirement)
    {
        if (!($sponsorRequirement->path == '' || $sponsorRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($sponsorRequirement->path);
        }

        $sponsorRequirement->update([
            'path' => ''
        ]);

        return response()->noContent();
    }
}
