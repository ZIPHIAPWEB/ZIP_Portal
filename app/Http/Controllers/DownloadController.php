<?php

namespace App\Http\Controllers;

use App\BasicRequirement;
use App\PaymentRequirement;
use App\ProgramRequirement;
use App\SponsorRequirement;
use App\User;
use App\VisaRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use ZipArchive;

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
        return Storage::disk('uploaded_files')->url(BasicRequirement::find($id)->path);
    }

    public function downloadPaymentRequirement($id)
    {
        return Storage::disk('uploaded_files')->url(PaymentRequirement::find($id)->path);
    }

    public function downloadVisaRequirement($id)
    {
        return Storage::disk('uploaded_files')->url(VisaRequirement::find($id)->path);
    }

    public function downloadStudentFiles($id)
    {
        $uniqueID = User::find($id)->email;

        if (File::exists(public_path('backup'))) {
            $this->zipData(public_path('uploaded/'. $uniqueID ) , public_path('backup/' . $uniqueID . '.zip'));
        } else {
            mkdir(public_path('backup'), 765, true, true);
            $this->zipData(public_path('uploaded/'. $uniqueID ) , public_path('backup/' . $uniqueID . '.zip'));
        }

        return response()->json(asset('backup/'. $uniqueID . '.zip'));
    }

    function zipData($source, $destination) {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new ZipArchive();
                if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    if (is_dir($source)) {
                        $iterator = new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS);

                        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = realpath($file);
                            if (is_dir($file)) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }
}
