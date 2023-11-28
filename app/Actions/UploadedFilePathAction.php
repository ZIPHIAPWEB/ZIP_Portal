<?php

namespace App\Actions;

class UploadedFilePathAction
{
    public function execute($request, $directory): string
    {
        $extension = $request->getClientOriginalExtension();

        return $request->storeAs(auth()->user()->email . '/' . $directory, date('Ymd') . uniqid() . '.' . $extension, 'uploaded_files');
    }
}
