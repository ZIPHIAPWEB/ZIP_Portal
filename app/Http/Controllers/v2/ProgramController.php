<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Program;
use App\ProgramCategory;
use Illuminate\Http\Response;

class ProgramController extends Controller
{
    public function getPrograms()
    {
        $programs  = Program::with('programCategory')
            ->orderByDesc('name')
            ->get()
            ->map(function ($program) {
                return [
                    'id' => $program->id,
                    'name' => $program->name,
                    'display_name' => $program->display_name,
                    'description' => $program->description,
                    'category' => $program->programCategory ? $program->programCategory->only(['id', 'name', 'display_name', 'description']) : null,
                ];
            });

        return response()->json($programs, Response::HTTP_OK);
    }
}
