<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\SponsorRequirement;
use Illuminate\Http\Request;

class StudentVisaSponsorRequirementController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student()->first();

        $visaSponsorRequirements = SponsorRequirement::where('sponsor_id', $student->visa_sponsor_id)
            ->where('is_active', true)
            ->with(['studentVisa' => function ($query) use ($student) {
                $query->where('user_id', $student->user_id);
            }])
            ->get();

        return response()->json([
            'data' => $visaSponsorRequirements
        ], 200);
    }
}
