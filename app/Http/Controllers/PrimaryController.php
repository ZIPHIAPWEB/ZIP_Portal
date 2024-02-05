<?php

namespace App\Http\Controllers;

use App\Repositories\Primary\PrimaryRepository;
use Illuminate\Http\Request;

class PrimaryController extends Controller
{
    private $primaryRepository;
    public function __construct(PrimaryRepository $primaryRepository)
    {
        $this->primaryRepository = $primaryRepository;
    }

    public function update(Request $request, $field, $id)
    {
        $this->primaryRepository->whereUpdate(['id' => $id], [
            $field => $request->input('field')
        ]);

        return response()->json(['message' => 'Primary Updated']);
    }

    public function delete($id)
    {
        $this->primaryRepository->deletePrimary($id);

        return response()->json(['message' => 'Primary Deleted']);
    }
}
