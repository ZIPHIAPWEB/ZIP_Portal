<?php

namespace App\Http\Controllers;

use App\Repositories\Experience\ExperienceRepository;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    private $experienceRepository;
    public function __construct(ExperienceRepository $experienceRepository)
    {
        $this->experienceRepository = $experienceRepository;
    }

    public function update(Request $request, $field, $id)
    {
        $this->experienceRepository->whereUpdate(['id' => $id], [
            $field => $request->input('field')
        ]);

        return response()->json(['message' => 'Experience Updated']);
    }

    public function delete($id)
    {
        $this->experienceRepository->deleteExperience($id);

        return response()->json(['message' => 'Experience Deleted']);
    }
}
