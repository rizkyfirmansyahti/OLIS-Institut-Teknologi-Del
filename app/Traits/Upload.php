<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


trait Upload
{
    protected function uploadFile($fileUpload, $folderParent, $folderChild = null)
    {
        if (env('APP_GOOGLE_DRIVE_UPLOAD', false)) {
            return $this->uploadGoogleDrive($fileUpload, $folderParent, $folderChild);
        } else {
            return $this->uploadPublic($fileUpload, $folderParent, $folderChild);
        }
    }

    protected function uploadGoogleDrive($fileUpload, $folderParent, $folderChild = null)
    {
        if (empty($fileUpload)) return null;
        if ($fileUpload instanceof UploadedFile && $fileUpload->isValid()) {
            $folder = $folderParent;
            if (!empty($folderChild)) {
                $folder .= '/' . $folderChild;
            }
            $image_name = time() . '.' . $fileUpload->getClientOriginalExtension();
            $image_name = $folder . '/' . $image_name;
            Storage::disk('google')->put($image_name, file_get_contents($fileUpload));
            $path = Storage::disk('google')->url($image_name);
            return $path;
        }
        return null;
    }

    protected function uploadPublic($fileUpload, $folderParent, $folderChild = null)
    {
        if (empty($fileUpload)) return null;
        if ($fileUpload instanceof UploadedFile && $fileUpload->isValid()) {
            $folder = $folderParent;
            if (!empty($folderChild)) {
                $folder .= '/' . $folderChild;
            }
            $image_name = time() . '.' . $fileUpload->getClientOriginalExtension();
            $fileUpload->move(public_path($folder), $image_name);
            $path = asset($folder . '/' . $image_name);
            return $path;
        }
        return null;
    }

    protected function deleteFile($path)
    {
        if (env('APP_GOOGLE_DRIVE_UPLOAD', false)) {
            return $this->deleteGoogleDrive($path);
        } else {
            return $this->deletePublic($path);
        }
    }

    protected function deleteGoogleDrive($path)
    {
        if (empty($path)) return null;
        Storage::disk('google')->delete($path);
        return true;
    }

    protected function deletePublic($path)
    {
        if (empty($path)) return null;
        $path = str_replace(asset(''), '', $path);
        $path = public_path($path);
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }
}
