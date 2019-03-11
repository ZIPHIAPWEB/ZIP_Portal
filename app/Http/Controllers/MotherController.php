<?php

namespace App\Http\Controllers;

use App\Repositories\Mother\MotherRepository;
use Illuminate\Http\Request;

class MotherController extends Controller
{
    private $motherRepository;
    public function __construct(MotherRepository $motherRepository)
    {
        $this->motherRepository = $motherRepository;
    }

    public function update(Request $request, $field, $id)
    {
        $this->motherRepository->whereUpdate(['id' => $id], [
            $field =>  $request->input('field')
        ]);

        return response()->json(['message' => 'Mother Updated']);
    }

    public function delete($id)
    {
        $this->motherRepository->deleteMother($id);

        return response()->json(['message' => 'Mother Deleted']);
    }
}
