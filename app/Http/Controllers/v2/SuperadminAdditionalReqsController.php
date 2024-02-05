<?php

namespace App\Http\Controllers\v2;

use App\Actions\UploadedFilePathAction;
use App\AdditionalRequirement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SuperadminAdditionalReqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reqs = AdditionalRequirement::query()
            ->orderBy('created_at', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Additional requirements successfully loaded',
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
        $createdReqs = AdditionalRequirement::create([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'path' => $request->hasFile('file') ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Additional requirement successfully created',
            'data' => $createdReqs
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdditionalRequirement  $additionalRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalRequirement $additionalRequirement)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Additional requirement successfully loaded',
            'data' => $additionalRequirement
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdditionalRequirement  $additionalRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdditionalRequirement $additionalRequirement)
    {
        if (!($additionalRequirement->path == '' || $additionalRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($additionalRequirement->path);
        }

        $additionalRequirement->update([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'path' => ($request->hasFile('file')) ? (new UploadedFilePathAction())->execute($request->file('file'), 'programRequirements') : null
        ]);

        $additionalRequirement->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Additional requirement successfully updated',
            'data' => $additionalRequirement
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdditionalRequirement  $additionalRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalRequirement $additionalRequirement)
    {
        if (!($additionalRequirement->path == '' || $additionalRequirement->path == null)) {

            Storage::disk('uploaded_files')->delete($additionalRequirement->path);
        }

        $additionalRequirement->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Additional requirement successfully deleted'
        ], Response::HTTP_OK);
    }
}
