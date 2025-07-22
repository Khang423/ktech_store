<?php

namespace App\Services;

use App\Enums\ProductTypeEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\LaptopSpec;
use App\Models\PhoneSpec;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Traits\ImageTrait;

class ProductService extends Controller
{
    private Model $model;
    private $imageTrait;

    public function __construct(ProductVersion $productVersions, ImageTrait $imageTrait)
    {
        $this->model = $productVersions;
        $this->imageTrait = $imageTrait;
    }

    public function getList()
    {
        return DataTables::of(
            Product::select(Product::getInfo())
                ->orderBy('created_at', 'desc')
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('thumbnail', function ($object) {
                return [
                    'thumbnail' => $object->thumbnail,
                    'id' => $object->id,
                ];
            })
            ->editColumn('name', function ($object) {
                return $object->name;
            })
            ->editColumn('status', function ($object) {
                if ($object->status == StatusEnum::ON) {
                    return StatusEnum::ON;
                }
                return StatusEnum::OFF;
            })
            ->addColumn('actions', function ($object) {

                return [
                    'id' => $object->id,
                    'destroy' => '',
                    'edit' => route('admin.products.edit', $object),
                    'view' => ' ',
                    'list' => route('admin.products.productsVersion.index', [
                        'products' => $object
                    ]),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'usage_type_id' => $request->usage_type_id,
                'model_series_id' => $request->model_series_id,
                'category_product_id' => $request->category_product_id,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'status' => StatusEnum::ON,
            ]);

            // thumbnail
            if ($request->hasFile('thumbnail')) {
                $thumbnailName = $this->imageTrait->storeImage($request->thumbnail, 'products', $product->id, 'thumbnail');
            }

            $product->update([
                'thumbnail' => $thumbnailName,
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->image as $image) {
                    $imageName = $this->imageTrait->storeImage($image, 'products', $product->id, 'image');
                    ProductImage::query()->create(
                        [
                            'product_id' => $product->id,
                            'image' => $imageName
                        ]
                    );
                }
            }


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function update($request, $products)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('id', $products->id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'usage_type_id' => $request->usage_type_id,
                'model_series_id' => $request->model_series_id,
                'category_product_id' => $request->category_product_id,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'status' => StatusEnum::ON,
            ]);


            // thumbnail
            if ($request->hasFile('thumbnail_new')) {
                $thumbnailName = $this->imageTrait->storeImage($request->thumbnail_new, 'products', $products->id, 'thumbnail');
                $result = $this->imageTrait->deleteImage($request->thumbnail_old, 'products', $products->id);
                if ($result) {
                    Product::where('id',$products->id)->update([
                        'thumbnail' => $thumbnailName
                    ]);
                }
            }

            // add image
            if ($request->hasFile('image_add')) {
                foreach ($request->image_add as $image) {
                    $imageName = $this->imageTrait->storeImage($image, 'products', $products->id, 'image');
                    if ($imageName) {
                        ProductImage::query()->create(
                            [
                                'product_id' => $products->id,
                                'image' => $imageName
                            ]
                        );
                    }
                }
            }

            // dd($request->image_update);
            if ($request->hasFile('image_update')) {
                $deleteImage = false;
                $image_update_name = null;
                foreach ($request->product_image_old_id as $index => $old_id) {
                    if (isset($request->image_old[$index]) && $request->hasFile("image_update.$index")) {
                        $deleteImage = $this->imageTrait->deleteImage(
                            $request->image_old[$index],
                            'products',
                            $products->id
                        );

                        $image_update_name = $this->imageTrait->storeImage(
                            $request->file("image_update.$index"),
                            'products',
                            $products->id,
                            'image'
                        );

                        if ($deleteImage && $image_update_name !== false) {
                            ProductImage::query()
                                ->where('id', $old_id)
                                ->update([
                                    'image' => $image_update_name
                                ]);
                        }
                    }
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $product_version_id = $request->id;
            $product = ProductVersion::find($product_version_id);
            $product_id = $product->product_id;
            $path = 'asset/admin/products/' . $product_version_id;
            Storage::disk('public_path')->deleteDirectory($path);
            $product->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }


    public function delete_image($request)
    {
        try {
            $product_id = $request->product_id;
            $this->imageTrait->deleteImage($request->image, 'products', $product_id);
            ProductImage::query()
                ->where('product_id', $product_id)
                ->where('id', $request->id)
                ->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateStatus($request)
    {
        DB::beginTransaction();
        try {
            if ($request->status === 'checked') {
                Product::where('id', $request->product_id)->update(['status' => StatusEnum::ON]);
            } else {
                Product::where('id', $request->product_id)->update(['status' => StatusEnum::OFF]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function destroy($request)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->id);
            $product->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function forceDelete($request)
    {
        DB::beginTransaction();
        try {
            Product::onlyTrashed()->forceDelete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function restoreAll()
    {
        DB::beginTransaction();
        try {
            Product::onlyTrashed()->restore();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
