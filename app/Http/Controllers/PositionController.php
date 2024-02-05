<?php

namespace App\Http\Controllers;

use App\Repositories\Position\PositionRepository;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    private $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function getAll()
    {
        $position = $this->positionRepository->getAll();

        return response()->json($position);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ]);

        $position = $this->positionRepository->savePosition($request->all());

        return response()->json([
            'message' => 'Position Added'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          =>  'required',
            'display_name'  =>  'required'
        ]);

        $position = $this->positionRepository->updatePosition($id, $request->all());

        return response()->json([
            'message'   =>  'Position Updated'
        ]);
    }

    public function delete($id)
    {
        $this->positionRepository->deletePosition($id);

        return response()->json([
            'message'   =>  'Position Deleted'
        ]);
    }
}
