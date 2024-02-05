<?php

namespace App\Actions;

class UploadedFilePathAction
{
    public function execute($request, $directory): string
    {
        $extension = $request->getClientOriginalExtension();

        $user = auth()->user();

        $path = (!in_array('superadmin', $user->roles->toArray())) ? $directory : $user->email . '/' . $directory;

        $filename = date('Ymd') . uniqid() . '.' . $extension;

        return $request->storeAs($path, $filename, 'uploaded_files');
    }
}
