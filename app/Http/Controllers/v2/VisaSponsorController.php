<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisaSponsorResource;
use App\Sponsor;

class VisaSponsorController extends Controller
{
    public function getVisaSponsors()
    {
        $sponsors = Sponsor::query()->orderBy('display_name', 'ASC')->get();

        return VisaSponsorResource::collection($sponsors);
    }
}
