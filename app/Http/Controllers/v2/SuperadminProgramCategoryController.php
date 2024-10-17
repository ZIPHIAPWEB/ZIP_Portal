<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramCategoryCreateUpdateRequest;
use App\Http\Resources\SuperadminProgramCategoryResource;
use App\ProgramCategory;

class SuperadminProgramCategoryController extends Controller
{
    public function index()
    {
        $categories = ProgramCategory::query()
            ->orderByDesc('created_at')
            ->get();

        return SuperadminProgramCategoryResource::collection($categories);
    }

    public function store(ProgramCategoryCreateUpdateRequest $request)
    {
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

    public function update(ProgramCategoryCreateUpdateRequest $request, ProgramCategory $programCategory)
    {
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
