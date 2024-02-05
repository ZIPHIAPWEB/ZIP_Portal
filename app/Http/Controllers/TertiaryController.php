<?php

namespace App\Http\Controllers;

use App\Repositories\Tertiary\TertiaryRepository;
use Illuminate\Http\Request;

class TertiaryController extends Controller
{
    private $tertiaryRepository;
    public function __construct(TertiaryRepository $tertiaryRepository)
    {
        $this->tertiaryRepository = $tertiaryRepository;
    }

    public function update(Request $request, $field, $id)
    {
        $this->tertiaryRepository->whereUpdate(['id' => $id], [
            $field => $request->input('field')
        ]);

        return response()->json(['message' => 'Tertiary Update']);
    }

    public function delete($id)
    {
        $this->tertiaryRepository->deleteTertiary($id);

        return response()->json(['message' => 'Tertiary Delete']);
    }
}
