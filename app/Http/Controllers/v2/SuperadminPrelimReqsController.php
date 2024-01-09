<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\Http\Controllers\Controller;
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
            ->orderBy('created_at', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Preliminary requirements successfully loaded',
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
        $createdReqs = PreliminaryRequirement::create([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'path' => $request->hasFile('file') ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Preliminary requirement successfully created',
            'data' => $createdReqs
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
            'data' => $preliminaryRequirement
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreliminaryRequirement  $preliminaryRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreliminaryRequirement $preliminaryRequirement)
    {
        if (!($preliminaryRequirement->path == '' || $preliminaryRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($preliminaryRequirement->path);
        }

        $preliminaryRequirement->update([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'path' => ($request->hasFile('file')) ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        $preliminaryRequirement->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Preliminary requirement successfully updated',
            'data' => $preliminaryRequirement
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
}
