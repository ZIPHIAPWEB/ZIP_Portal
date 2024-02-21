<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuperadminProgramCategoryResource;
use App\ProgramCategory;
use Illuminate\Http\Request;

class SuperadminProgramCategoryController extends Controller
{
    public function index()
    {
        $categories = ProgramCategory::query()
            ->orderByDesc('created_at')
            ->get();

        return SuperadminProgramCategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ]);

        $storedCategory = ProgramCategory::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        return new SuperadminProgramCategoryResource($storedCategory);
    }

    public function show(ProgramCategory $programCategory)
    {
        return new SuperadminProgramCategoryResource($programCategory);
    }

    public function update(Request $request, ProgramCategory $programCategory)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ]);

        $programCategory->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        return response()->noContent();
    }

    public function destroy(ProgramCategory $programCategory)
    {
        if (!$programCategory->exists()) {

            abort(404, 'Program category not found.');
        }

        $programCategory->delete();

        return response()->noContent();
    }
}
