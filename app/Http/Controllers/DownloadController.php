<?php

namespace App\Http\Controllers;

use App\BasicRequirement;
use App\PaymentRequirement;
use App\ProgramRequirement;
use App\SponsorRequirement;
use App\VisaRequirement;
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

    public function downloadBasicRequirement($id)
    {
        return Storage::disk('local')->url(BasicRequirement::find($id)->path);
    }

    public function downloadPaymentRequirement($id)
    {
        return Storage::url(PaymentRequirement::find($id)->path);
    }

    public function downloadVisaRequirement($id)
    {
        return Storage::url(VisaRequirement::find($id)->path);
    }
}
