<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class ImageTrait
{
    protected $imageManager;

    function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    function convertToWebpAndStore($image, $folderName)
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


    public function storeImage($image, $folderName, $product_id, $image_type)
    {
        if ($image_type == 'thumbnail') {
            if ($image && $folderName && $product_id != null) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($image);
                $encode = $image->toWebp(80);
                $thumbnailName =  uniqid('thumbnail_') . '.webp';
                $path = 'asset/admin/' . $folderName . '/' . $product_id . '/' . $thumbnailName;
                Storage::disk('public_path')->put($path, $encode->toString());
                return $thumbnailName;
            } else if ($image && $folderName && $product_id == 'null') {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($image);
                $encode = $image->toWebp(80);
                $thumbnailName =  uniqid('thumbnail_') . '.webp';
                $path = 'asset/admin/' . $folderName . '/' . $thumbnailName;
                Storage::disk('public_path')->put($path, $encode->toString());
                return $thumbnailName;
            }
        } else if ($image_type == 'image') {
            if ($image && $folderName && $product_id != null) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($image);
                $encode = $image->toWebp(80);
                $thumbnailName =  uniqid('image_') . '.webp';
                $path = 'asset/admin/' . $folderName . '/' . $product_id . '/' . 'image' . '/' . $thumbnailName;
                Storage::disk('public_path')->put($path, $encode->toString());
                return $thumbnailName;
            }
        } else if ($image_type == 'thumbnail_version') {
            if ($image && $folderName && $product_id != null) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($image);
                $encode = $image->toWebp(80);
                $thumbnailName =  uniqid('image_') . '.webp';
                $path = 'asset/admin/' . $folderName . '/' . $product_id . '/' . 'thumbnail' . '/' . $thumbnailName;
                Storage::disk('public_path')->put($path, $encode->toString());
                return $thumbnailName;
            }
        } else {
            return false;
        }
    }

    public function deleteImage($image, $folderName, $product_id)
    {
        if ($image && $folderName && $product_id != null) {
            $pathThumbnail = 'asset/admin/' . $folderName . '/' . $product_id . '/' . $image;
            $pathImage = 'asset/admin/' . $folderName . '/' . $product_id . '/' . 'image' . '/' . $image;
            Storage::disk('public_path')->delete([$pathThumbnail, $pathImage]);
            return true;
        } else if ($image && $folderName && $product_id == null) {
            $path = 'asset/admin/' . $folderName . '/' . $image;
            Storage::disk('public_path')->delete($path);
            return true;
        }
        return false;
    }
}
