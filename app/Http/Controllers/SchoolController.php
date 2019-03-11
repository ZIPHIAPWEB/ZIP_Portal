<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Repositories\School\SchoolRepository;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    private $schoolRepository;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function view()
    {
        $schools = $this->schoolRepository->getAllSchool();

        return SuperAdminResource::collection($schools);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required'
        ])->validate();

        $school = $this->schoolRepository->saveSchool([
            'name'          => $request->input('name'),
            'display_name'  => $request->input('display_name'),
            'description'   => $request->input('description')
        ]);

        return response()->json(['message' => 'School Added Successfully']);
    }

    public function edit($id)
    {
        $school = $this->schoolRepository->getSchoolById($id);

        return new SuperAdminResource($school);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
            'description'   => 'required'
        ])->validate();

        $school = $this->schoolRepository->updateSchool($id, [
            'name'          => $request->input('name'),
            'display_name'  => $request->input('display_name'),
            'description'   => $request->input('description')
        ]);

        return response()->json(['message' => 'School Updated Successfully']);
    }

    public function delete($id)
    {
        $this->schoolRepository->deleteSchool($id);

        return response()->json(['message' => 'School Delete Successfully']);
    }
}
