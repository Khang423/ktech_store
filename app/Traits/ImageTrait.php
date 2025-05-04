<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageTrait
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function convertToWebpAndStore($image, $folderName)
    {
        if ($image && $folderName) {
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($image);
            $encode = $image->toWebp(80);
            $thumbnailName =  uniqid('thumbnail_') . '.webp';
            $path = 'asset/admin/' . $folderName . '/' . $thumbnailName;
            Storage::disk('public_path')->put($path, $encode->toString());
            return $thumbnailName;
        }
        return false;
    }

    public function deleteImage($image, $folderName)
    {
        if ($image && $folderName) {
            $path = 'asset/admin/' . $folderName . '/' . $image;
            Storage::disk('public_path')->delete($path);
            return true;
        }
        return false;
    }
}
