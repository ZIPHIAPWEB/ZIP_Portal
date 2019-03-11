<?php

namespace App\Http\Controllers;

use App\Repositories\Secondary\SecondaryRepository;
use Illuminate\Http\Request;

class SecondaryController extends Controller
{
    private $secondaryRepository;
    public function __construct(SecondaryRepository $secondaryRepository)
    {
        $this->secondaryRepository = $secondaryRepository;
    }

    public function update(Request $request, $field, $id)
    {
        $this->secondaryRepository->whereUpdate(['id' => $id], [
            $field => $request->input('field')
        ]);

        return response()->json(['message' => 'Secondary Updated']);
    }

    public function delete($id)
    {
        $this->secondaryRepository->deleteSecondary($id);

        return response()->json(['message' => 'Secondary Deleted']);
    }
}
