<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 *
 *
 */
class UploadService
{


    // Upload Image Avatar
    public function uploadImageHandler($file, $name, $path)
    {

        $extension = $file->extension();

        // Customize Image Url
        $time = date('Y-m-d-H-i-s-');
        $name = Str::slug($name) . '.';
        $imageName = $time . $name . $extension;

        // Upload
        $resultImageAvatar = $file->move($path, $imageName);

        if ($resultImageAvatar) {
            return $imageName;
        }
    }

    // Upload Image Detail
    public function uploadImageDetailHandler($file, $room_name, $key)
    {
        $extension = $file->extension();

        // Customize Image Url
        $time = date('Y-m-d-H-i-s-');
        $name = Str::slug($room_name) . '-detail-' . $key + 1 . '.';
        $imageNameDetail = $time . $name . $extension;

        // Uploads
        $resultImageDetail = $file->move('uploads/rooms/room_details', $imageNameDetail);

        if ($resultImageDetail) {
            return $imageNameDetail;
        }
    }

    public function deleteFile($filename, $path)
    {
        if (File::exists($path . $filename)) {
            File::delete($path . $filename);
        }
    }
}
