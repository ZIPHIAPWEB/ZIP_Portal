<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrelimRequirementCreateUpdateRequest;
use App\Http\Resources\SuperadminPrelimRequirementResource;
use App\PreliminaryRequirement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SuperadminPrelimReqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reqs = PreliminaryRequirement::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return SuperadminPrelimRequirementResource::collection($reqs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrelimRequirementCreateUpdateRequest $request)
    {
        $createdReqs = PreliminaryRequirement::create([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active') == 'true' ? 1 : 0
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Preliminary requirement successfully created',
            'data' => new SuperadminPrelimRequirementResource($createdReqs)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreliminaryRequirement  $preliminaryRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(PreliminaryRequirement $preliminaryRequirement)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Preliminary requirement successfully loaded',
            'data' => new SuperadminPrelimRequirementResource($preliminaryRequirement)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreliminaryRequirement  $preliminaryRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(PrelimRequirementCreateUpdateRequest $request, PreliminaryRequirement $preliminaryRequirement)
    {
        if (!($preliminaryRequirement->path == '' || $preliminaryRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($preliminaryRequirement->path);
        }

        $preliminaryRequirement->update([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active') == 'true' ? 1 : 0
        ]);

        $preliminaryRequirement->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Preliminary requirement successfully updated',
            'data' => new SuperadminPrelimRequirementResource($preliminaryRequirement)
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreliminaryRequirement  $preliminaryRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreliminaryRequirement $preliminaryRequirement)
    {
        if (!($preliminaryRequirement->path == '' || $preliminaryRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($preliminaryRequirement->path);
        }

        $preliminaryRequirement->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Preliminary requirement successfully deleted'
        ], Response::HTTP_OK);
    }

    public function uploadPrelimFile(Request $request, PreliminaryRequirement $preliminaryRequirement)
    {
        if(!$preliminaryRequirement->exists()) {

            abort(404, 'Prelim requirement not found.');
        }

        if (!($preliminaryRequirement->path == '' || $preliminaryRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($preliminaryRequirement->path);
        }

        $preliminaryRequirement->update([
            'path' => ($request->hasFile('file')) ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        return response()->noContent();
    }

    public function removePrelimFile(PreliminaryRequirement $preliminaryRequirement)
    {
        if (!($preliminaryRequirement->path == '' || $preliminaryRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($preliminaryRequirement->path);
        }

        $preliminaryRequirement->update([
            'path' => ''
        ]);

        return response()->noContent();
    }
}
