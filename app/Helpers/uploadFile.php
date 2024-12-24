<?php

use Illuminate\Support\Facades\Storage;

function uploadFile($nameFolder, $file)
{
    $fileName = time() . '_' . $file->getClientOriginalName();
    return $file->storeAs($nameFolder, $fileName, 'public');
}

function deleteFile($filePath)
{
    if (Storage::disk('public')->exists($filePath)) {
        Storage::disk('public')->delete($filePath);
    }
}
