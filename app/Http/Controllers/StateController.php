<?php

namespace App\Http\Controllers;

use App\Repositories\State\StateRepository;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private $stateRepository;
    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function getAll()
    {
        $state = $this->stateRepository->getAllState();

        return response()->json($state);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'display_name'  =>  'required'
        ]);

        $state = $this->stateRepository->saveState($request->all());

        return response()->json([
            'message'   =>  'State added successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          =>  'required',
            'display_name'  =>  'required'
        ]);

        $state = $this->stateRepository->updateState($id, $request->all());

        return response()->json([
            'message'   => 'State updated successfully!'
        ]);
    }

    public function delete($id)
    {
        $this->stateRepository->deleteState($id);

        return response()->json([
            'message'   =>  'State deleted successfully'
        ]);
    }
}
