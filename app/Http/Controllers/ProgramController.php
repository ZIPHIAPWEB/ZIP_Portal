<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Program;
use App\ProgramRequirement;
use App\Repositories\Program\ProgramRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    private $programRepository;
    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    public function viewProgram()
    {
        $programs = $this->programRepository->getAllProgram();

        return SuperAdminResource::collection($programs);
    }

    public function storeProgram(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'display_name'  =>  'required',
            'description'   =>  'required'
        ])->validate();

        $this->programRepository->saveProgram([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Program Created']);
    }

    public function editProgram($id)
    {
        $program = $this->programRepository->getProgramById($id);

        return new SuperAdminResource($program);
    }

    public function updateProgram(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'display_name'  =>  'required',
            'description'   =>  'required'
        ])->validate();
        
        $this->programRepository->updateProgram($id, [
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Program Updated']);
    }

    public function deleteProgram($id)
    {
        $this->programRepository->delete($id);

        return response()->json(['message'  =>  'Program Deleted']);
    }
}
