<?php

namespace Classie\Http\Controllers;

use Classie\Http\Requests\FileUploadRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileUploadController extends Controller
{
    public function store(FileUploadRequest $request)
    {
        $requestImage = $request->file('image');
        $image = Image::make($requestImage);

        $path = Storage::disk('public')->path('tmp' . '/' . $requestImage->hashName());
        $image->resize(2000, 2000, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($path . '.jpg', 70, 'jpg');

        $thumbPath = Storage::disk('public')->path('tmp' . '/th_' . $requestImage->hashName());
        $image->resize(200, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbPath . '.jpg', 70, 'jpg');

        return $requestImage->hashName() . '.jpg';
    }
}
