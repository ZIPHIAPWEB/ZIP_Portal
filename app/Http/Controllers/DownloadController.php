<?php

namespace App\Http\Controllers;

use App\ProgramRequirement;
use App\SponsorRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadBasic($id)
    {
        return Storage::url(ProgramRequirement::find($id)->path);
    }

    public function downloadSponsor($id)
    {
        return Storage::url(SponsorRequirement::find($id)->path);
    }
}
