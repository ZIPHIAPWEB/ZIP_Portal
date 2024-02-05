<?php

namespace App\Http\Controllers;

use App\Repositories\Father\FatherRepository;
use Illuminate\Http\Request;

class FatherController extends Controller
{
    private $fatherRepository;
    public function __construct(FatherRepository $fatherRepository)
    {
        $this->fatherRepository = $fatherRepository;
    }

    public function update(Request $request, $field, $id)
    {
        $this->fatherRepository->whereUpdate(['id' => $id], [
             $field =>  $request->input('field')
        ]);

        return response()->json(['message' => 'Father Updated']);
    }

    public function delete($id)
    {
        $this->fatherRepository->deleteFather($id);

        return response()->json(['message' => 'Father Deleted']);
    }
}
