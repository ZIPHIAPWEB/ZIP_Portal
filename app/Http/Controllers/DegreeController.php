<?php

namespace App\Http\Controllers;

use App\Repositories\Degree\DegreeRepository;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    private $degreeRepository;
    public function __construct(DegreeRepository $degreeRepository)
    {
        $this->degreeRepository = $degreeRepository;
    }

    public function getAll()
    {
        $allDegree = $this->degreeRepository->getAllDegree();

        return response()->json($allDegree);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'display_name' => 'required'
        ]);

        $this->degreeRepository->saveDegree($request->all());

        return response()->json(['message' => 'Degree Added']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  =>  'required',
            'display_name'  =>  'required'
        ]);

        $this->degreeRepository->update($id, $request->all());

        return response()->json(['message' => 'Degree Updated']);
    }

    public function delete($id)
    {
        $this->degreeRepository->delete($id);

        return response()->json(['message' => 'Degree Deleted']);
    }
}
