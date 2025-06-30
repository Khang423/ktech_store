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
                ->with('firstProductVersion')
                ->orderBy('created_at', 'desc')
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('thumbnail', function ($object) {
                return [
                    'thumbnail' => $object->firstProductVersion->thumbnail,
                    'id' => $object->firstProductVersion->id,
                ];
            })
            ->editColumn('name', function ($object) {
                return $object->firstProductVersion->name;
            })
            ->editColumn('status', function ($object) {
                if ($object->status == StatusEnum::ON) {
                    return StatusEnum::ON;
                }
                return StatusEnum::OFF;
            })
            ->editColumn('price', function ($object) {
                return number_format($object->firstProductVersion->final_price, 0, ',', '.') . '₫';
            })
            ->addColumn('actions', function ($object) {

                return [
                    'id' => $object->id,
                    'destroy' => route('admin.products.delete'),
                    'list' => route('admin.products.productsVersion.index', $object->firstProductVersion),
                ];
            })
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            // insert product
            $dataProduct = [];
            $dataProduct['category_product_details_id'] = $request->category_product_detail_id;
            $dataProduct['brand_id'] = $request->brand_id;
            $dataProduct['status'] = StatusEnum::ON;
            $product = Product::create($dataProduct);
            // product_id
            $product_id = $product->id;
            // insert product version
            $dataProductVersion = [];
            $dataProductVersion['product_id'] = $product_id;
            $dataProductVersion['name'] = $request->name;
            $dataProductVersion['slug'] = Str::slug($request->name);
            $dataProductVersion['price'] = $request->price;
            $dataProductVersion['description'] = $request->description;

            $productVersion = ProductVersion::create($dataProductVersion);
            //productversion_id
            $productVersion_id = $productVersion->id;

            switch ($request->product_type) {
                case ProductTypeEnum::LAPTOP:
                    // insert product detail
                    $dataLaptop = [];
                    $dataLaptop['product_id'] = $productVersion_id;
                    $dataLaptop['gpu'] = $request->gpu_laptop;
                    $dataLaptop['cpu'] = $request->cpu;
                    $dataLaptop['ram_size'] = $request->ram_size_laptop;
                    $dataLaptop['ram_type'] = $request->ram_type;
                    $dataLaptop['ram_slot'] = $request->ram_slot;
                    $dataLaptop['storage_type'] = $request->storage_type;
                    $dataLaptop['storage_size'] = $request->storage_size_laptop;
                    $dataLaptop['display_size'] = $request->display_size_laptop;
                    $dataLaptop['display_resolution'] = $request->display_resolution_laptop;
                    $dataLaptop['display_technology'] = $request->display_technology;
                    $dataLaptop['display_panel'] = $request->display_panel;
                    $dataLaptop['refresh_rate'] = $request->refresh_rate;
                    $dataLaptop['audio_technology'] = $request->audio_technology_laptop;
                    $dataLaptop['memory_card_slot'] = $request->memory_card_slot;
                    $dataLaptop['wifi'] = $request->wifi_laptop;
                    $dataLaptop['bluetooth_version'] = $request->bluetooth_version;
                    $dataLaptop['usb_ports'] = $request->usb_ports;
                    $dataLaptop['dimension'] = $request->dimension;
                    $dataLaptop['weight'] = $request->weight_laptop;
                    $dataLaptop['material'] = $request->material;
                    $dataLaptop['operating_system'] = $request->operating_system;
                    $dataLaptop['webcam'] = $request->webcam;
                    $dataLaptop['battery'] = $request->battery;
                    $dataLaptop['keyboard_type'] = $request->keyboard_type;
                    $dataLaptop['other_feature'] = $request->other_feature;
                    $dataLaptop['security'] = $request->security;
                    $dataPhone['release_date'] = $request->release_date_laptop;
                    LaptopSpec::query()->create($dataLaptop);
                    break;
                case ProductTypeEnum::PHONE:
                    $dataPhone = [];
                    $dataPhone['product_id'] = $productVersion_id;
                    $dataPhone['display_size'] = $request->display_size_phone;
                    $dataPhone['display_type'] = $request->display_type;
                    $dataPhone['display_resolution'] = $request->display_resolution_phone;
                    $dataPhone['display_refresh_rate'] = $request->display_refresh_rate;
                    $dataPhone['display_features'] = $request->display_features;
                    $dataPhone['rear_camera'] = $request->rear_camera;
                    $dataPhone['front_camera'] = $request->front_camera;
                    $dataPhone['camera_features'] = $request->camera_features;
                    $dataPhone['chipset'] = $request->chipset;
                    $dataPhone['gpu'] = $request->gpu_phone;
                    $dataPhone['nfc_support'] = $request->nfc_support;
                    $dataPhone['sim_type'] = $request->sim_type;
                    $dataPhone['network_support'] = $request->network_support;
                    $dataPhone['gps_support'] = $request->gps_support;
                    $dataPhone['ram_size'] = $request->ram_size_phone;
                    $dataPhone['storage_size'] = $request->storage_size_phone;
                    $dataPhone['battery_capacity'] = $request->battery_capacity;
                    $dataPhone['charging_port'] = $request->charging_port;
                    $dataPhone['charging_technology'] = $request->charging_technology;
                    $dataPhone['weight'] = $request->weight_phone;
                    $dataPhone['frame_material'] = $request->frame_material;
                    $dataPhone['dimension'] = $request->dimension;
                    $dataPhone['operating_system'] = $request->operating_system_phone;
                    $dataPhone['water_dust_resistance'] = $request->water_dust_resistance;
                    $dataPhone['audio_technology'] = $request->audio_technology_phone;
                    $dataPhone['fingerprint_sensor'] = $request->fingerprint_sensor;
                    $dataPhone['other_sensors'] = $request->other_sensors;
                    $dataPhone['wifi_technology'] = $request->wifi_technology;
                    $dataPhone['bluetooth_technology'] = $request->bluetooth_technology;
                    $dataPhone['release_date'] = $request->release_date_phone;
                    PhoneSpec::query()
                        ->where('product_id', $productVersion_id)
                        ->create($dataPhone);
                    break;
                case ProductTypeEnum::MOUSE:
                    break;
                case ProductTypeEnum::KEYBOARD:
                    break;
                case ProductTypeEnum::HEADPHONE:
                    break;
            }

            // thumbnail
            if ($request->hasFile('thumbnail')) {
                $thumbnailName = $this->imageTrait->storeImage($request->thumbnail, 'products', $productVersion_id, 'thumbnail');
            }
            ProductVersion::query()
                ->where('id', $productVersion_id)
                ->update([
                    'thumbnail' => $thumbnailName
                ]);

            // image[]

            if ($request->hasFile('image')) {
                foreach ($request->image as $image) {
                    $imageName = $this->imageTrait->storeImage($image, 'products', $productVersion_id, 'image');
                    ProductImage::query()->create(
                        [
                            'product_id' => $productVersion_id,
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

    public function update($request, $product_version)
    {
        DB::beginTransaction();
        try {
            // insert product
            $dataProduct = [];
            $dataProduct['category_product_details_id'] = $request->category_product_detail_id;
            $dataProduct['brand_id'] = $request->brand_id;
            $dataProduct['status'] = StatusEnum::ON;
            Product::query()
                ->where('id', $product_version->product_id)
                ->update($dataProduct);
            // product_id
            $product_id = $product_version->product_id;
            // insert product version
            $import_price = (int) preg_replace('/[^\d]/', '', $request->import_price);
            $final_price = (int) preg_replace('/[^\d]/', '', $request->final_price);
            $dataProductVersion = [];
            $dataProductVersion['product_id'] = $product_id;
            $dataProductVersion['name'] = $request->name;
            $dataProductVersion['slug'] = Str::slug($request->name);
            $dataProductVersion['price'] = $request->price;
            $dataProductVersion['description'] = $request->description;
            $dataProductVersion['final_price'] = $final_price;
            $dataProductVersion['profit_rate'] = $request->profit_rate;
            $dataProductVersion['price'] = $import_price;

            ProductVersion::query()
                ->where('id', $product_version->id)
                ->update($dataProductVersion);
            //productversion_id
            $productVersion_id = $product_version->id;

            switch ($request->product_type) {
                case ProductTypeEnum::LAPTOP:
                    // insert product detail
                    $dataLaptop = [];
                    $dataLaptop['gpu'] = $request->gpu_laptop;
                    $dataLaptop['cpu'] = $request->cpu;
                    $dataLaptop['ram_size'] = $request->ram_size_laptop;
                    $dataLaptop['ram_type'] = $request->ram_type;
                    $dataLaptop['ram_slot'] = $request->ram_slot;
                    $dataLaptop['storage_type'] = $request->storage_type;
                    $dataLaptop['storage_size'] = $request->storage_size_laptop;
                    $dataLaptop['display_size'] = $request->display_size_laptop;
                    $dataLaptop['display_resolution'] = $request->display_resolution_laptop;
                    $dataLaptop['display_technology'] = $request->display_technology;
                    $dataLaptop['display_panel'] = $request->display_panel;
                    $dataLaptop['refresh_rate'] = $request->refresh_rate;
                    $dataLaptop['audio_technology'] = $request->audio_technology_laptop;
                    $dataLaptop['memory_card_slot'] = $request->memory_card_slot;
                    $dataLaptop['wifi'] = $request->wifi_laptop;
                    $dataLaptop['bluetooth_version'] = $request->bluetooth_version;
                    $dataLaptop['usb_ports'] = $request->usb_ports;
                    $dataLaptop['dimension'] = $request->dimension;
                    $dataLaptop['weight'] = $request->weight_laptop;
                    $dataLaptop['material'] = $request->material;
                    $dataLaptop['operating_system'] = $request->operating_system;
                    $dataLaptop['webcam'] = $request->webcam;
                    $dataLaptop['battery'] = $request->battery;
                    $dataLaptop['keyboard_type'] = $request->keyboard_type;
                    $dataLaptop['other_feature'] = $request->other_feature;
                    $dataLaptop['security'] = $request->security;
                    $dataLaptop['release_date'] = $request->release_date_laptop;
                    LaptopSpec::query()
                        ->where('product_id', $productVersion_id)
                        ->update($dataLaptop);
                    break;
                case ProductTypeEnum::PHONE:
                    $dataPhone = [];
                    $dataPhone['display_size'] = $request->display_size_phone;
                    $dataPhone['display_type'] = $request->display_type;
                    $dataPhone['display_resolution'] = $request->display_resolution_phone;
                    $dataPhone['display_refresh_rate'] = $request->display_refresh_rate;
                    $dataPhone['display_features'] = $request->display_features;
                    $dataPhone['rear_camera'] = $request->rear_camera;
                    $dataPhone['front_camera'] = $request->front_camera;
                    $dataPhone['camera_features'] = $request->camera_features;
                    $dataPhone['chipset'] = $request->chipset;
                    $dataPhone['gpu'] = $request->gpu_phone;
                    $dataPhone['nfc_support'] = $request->nfc_support;
                    $dataPhone['sim_type'] = $request->sim_type;
                    $dataPhone['network_support'] = $request->network_support;
                    $dataPhone['gps_support'] = $request->gps_support;
                    $dataPhone['ram_size'] = $request->ram_size_phone;
                    $dataPhone['storage_size'] = $request->storage_size_phone;
                    $dataPhone['battery_capacity'] = $request->battery_capacity;
                    $dataPhone['charging_port'] = $request->charging_port;
                    $dataPhone['charging_technology'] = $request->charging_technology;
                    $dataPhone['weight'] = $request->weight_phone;
                    $dataPhone['frame_material'] = $request->frame_material;
                    $dataPhone['dimension'] = $request->dimension;
                    $dataPhone['operating_system'] = $request->operating_system_phone;
                    $dataPhone['water_dust_resistance'] = $request->water_dust_resistance;
                    $dataPhone['audio_technology'] = $request->audio_technology_phone;
                    $dataPhone['fingerprint_sensor'] = $request->fingerprint_sensor;
                    $dataPhone['other_sensors'] = $request->other_sensors;
                    $dataPhone['wifi_technology'] = $request->wifi_technology;
                    $dataPhone['bluetooth_technology'] = $request->bluetooth_technology;
                    $dataPhone['release_date'] = $request->release_date_phone;
                    PhoneSpec::query()
                        ->where('product_id', $productVersion_id)
                        ->update($dataPhone);
                    break;
                case ProductTypeEnum::MOUSE:
                    break;
                case ProductTypeEnum::KEYBOARD:
                    break;
                case ProductTypeEnum::HEADPHONE:
                    break;
            }
            // thumbnail
            if ($request->hasFile('thumbnail_new')) {
                $thumbnailName = $this->imageTrait->storeImage($request->thumbnail_new, 'products', $productVersion_id, 'thumbnail');
                $result = $this->imageTrait->deleteImage($request->thumbnail_old, 'products', $productVersion_id);
                if ($result) {
                    ProductVersion::query()
                        ->where('id', $productVersion_id)
                        ->update([
                            'thumbnail' => $thumbnailName
                        ]);
                }
            }


            // add image
            if ($request->hasFile('image_add')) {
                foreach ($request->image_add as $image) {
                    $imageName = $this->imageTrait->storeImage($image, 'products', $productVersion_id, 'image');
                    if ($imageName) {
                        ProductImage::query()->create(
                            [
                                'product_id' => $productVersion_id,
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
                            $productVersion_id
                        );

                        $image_update_name = $this->imageTrait->storeImage(
                            $request->file("image_update.$index"),
                            'products',
                            $productVersion_id,
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

    public function storeProductVersion($request, $productVersion)
    {
        DB::beginTransaction();
        try {
            // insert product
            // $dataProduct = [];
            // $dataProduct['category_product_details_id'] = $request->category_product_detail_id;
            // $dataProduct['brand_id'] = $request->brand_id;
            // $dataProduct['status'] = StatusEnum::ON;
            // $product = Product::create($dataProduct);
            // product_id
            $product_id = $productVersion->product_id;
            // insert product version
            $dataProductVersion = [];
            $dataProductVersion['product_id'] = $product_id;
            $dataProductVersion['name'] = $request->name;
            $dataProductVersion['slug'] = Str::slug($request->name);
            $dataProductVersion['price'] = $request->price;
            $dataProductVersion['description'] = $request->description;

            $productVersion = ProductVersion::create($dataProductVersion);
            //productversion_id
            $productVersion_id = $productVersion->id;

            switch ($request->product_type) {
                case ProductTypeEnum::LAPTOP:
                    // insert product detail
                    $dataLaptop = [];
                    $dataLaptop['product_id'] = $productVersion_id;
                    $dataLaptop['gpu'] = $request->gpu_laptop;
                    $dataLaptop['cpu'] = $request->cpu;
                    $dataLaptop['ram_size'] = $request->ram_size_laptop;
                    $dataLaptop['ram_type'] = $request->ram_type;
                    $dataLaptop['ram_slot'] = $request->ram_slot;
                    $dataLaptop['storage_type'] = $request->storage_type;
                    $dataLaptop['storage_size'] = $request->storage_size_laptop;
                    $dataLaptop['display_size'] = $request->display_size_laptop;
                    $dataLaptop['display_resolution'] = $request->display_resolution_laptop;
                    $dataLaptop['display_technology'] = $request->display_technology;
                    $dataLaptop['display_panel'] = $request->display_panel;
                    $dataLaptop['refresh_rate'] = $request->refresh_rate;
                    $dataLaptop['audio_technology'] = $request->audio_technology_laptop;
                    $dataLaptop['memory_card_slot'] = $request->memory_card_slot;
                    $dataLaptop['wifi'] = $request->wifi_laptop;
                    $dataLaptop['bluetooth_version'] = $request->bluetooth_version;
                    $dataLaptop['usb_ports'] = $request->usb_ports;
                    $dataLaptop['dimension'] = $request->dimension;
                    $dataLaptop['weight'] = $request->weight_laptop;
                    $dataLaptop['material'] = $request->material;
                    $dataLaptop['operating_system'] = $request->operating_system;
                    $dataLaptop['webcam'] = $request->webcam;
                    $dataLaptop['battery'] = $request->battery;
                    $dataLaptop['keyboard_type'] = $request->keyboard_type;
                    $dataLaptop['other_feature'] = $request->other_feature;
                    $dataLaptop['security'] = $request->security;
                    $dataPhone['release_date'] = $request->release_date_laptop;
                    LaptopSpec::query()->create($dataLaptop);
                    break;
                case ProductTypeEnum::PHONE:
                    $dataPhone = [];
                    $dataPhone['product_id'] = $productVersion_id;
                    $dataPhone['display_size'] = $request->display_size_phone;
                    $dataPhone['display_type'] = $request->display_type;
                    $dataPhone['display_resolution'] = $request->display_resolution_phone;
                    $dataPhone['display_refresh_rate'] = $request->display_refresh_rate;
                    $dataPhone['display_features'] = $request->display_features;
                    $dataPhone['rear_camera'] = $request->rear_camera;
                    $dataPhone['front_camera'] = $request->front_camera;
                    $dataPhone['camera_features'] = $request->camera_features;
                    $dataPhone['chipset'] = $request->chipset;
                    $dataPhone['gpu'] = $request->gpu_phone;
                    $dataPhone['nfc_support'] = $request->nfc_support;
                    $dataPhone['sim_type'] = $request->sim_type;
                    $dataPhone['network_support'] = $request->network_support;
                    $dataPhone['gps_support'] = $request->gps_support;
                    $dataPhone['ram_size'] = $request->ram_size_phone;
                    $dataPhone['storage_size'] = $request->storage_size_phone;
                    $dataPhone['battery_capacity'] = $request->battery_capacity;
                    $dataPhone['charging_port'] = $request->charging_port;
                    $dataPhone['charging_technology'] = $request->charging_technology;
                    $dataPhone['weight'] = $request->weight_phone;
                    $dataPhone['frame_material'] = $request->frame_material;
                    $dataPhone['dimension'] = $request->dimension;
                    $dataPhone['operating_system'] = $request->operating_system_phone;
                    $dataPhone['water_dust_resistance'] = $request->water_dust_resistance;
                    $dataPhone['audio_technology'] = $request->audio_technology_phone;
                    $dataPhone['fingerprint_sensor'] = $request->fingerprint_sensor;
                    $dataPhone['other_sensors'] = $request->other_sensors;
                    $dataPhone['wifi_technology'] = $request->wifi_technology;
                    $dataPhone['bluetooth_technology'] = $request->bluetooth_technology;
                    $dataPhone['release_date'] = $request->release_date_phone;
                    PhoneSpec::query()
                        ->where('product_id', $productVersion_id)
                        ->create($dataPhone);
                    break;
                case ProductTypeEnum::MOUSE:
                    break;
                case ProductTypeEnum::KEYBOARD:
                    break;
                case ProductTypeEnum::HEADPHONE:
                    break;
            }

            // thumbnail
            if ($request->hasFile('thumbnail')) {
                $thumbnailName = $this->imageTrait->storeImage($request->thumbnail, 'products', $productVersion_id, 'thumbnail');
            }
            ProductVersion::query()
                ->where('id', $productVersion_id)
                ->update([
                    'thumbnail' => $thumbnailName
                ]);

            // image[]

            if ($request->hasFile('image')) {
                foreach ($request->image as $image) {
                    $imageName = $this->imageTrait->storeImage($image, 'products', $productVersion_id, 'image');
                    ProductImage::query()->create(
                        [
                            'product_id' => $productVersion_id,
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

    public function getListProductVersion($request)
    {
        return DataTables::of(
            ProductVersion::where('product_id', $request->product_id)
                ->select(ProductVersion::getInfo())
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
            ->editColumn('price', function ($object) {
                return number_format($object->final_price, 0, ',', '.') . '₫';
            })
            ->addColumn('actions', function ($object) {

                return [
                    // 'id' => $object->id,
                    // 'destroy' => route('admin.products.delete'),
                    // 'edit' => route('admin.products.edit', $object->firstProductVersion),
                    // 'list' => route('admin.products.productsVersion.index', [
                    //     'productVersion' => $object->id,
                    // ]),
                    'id' => $object->id,
                    'destroy' => ' ',
                    'edit' => route('admin.products.productsVersion.edit', $object),
                    'list' => '',
                ];
            })
            ->make(true);
    }
}
