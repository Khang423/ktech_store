<?php

namespace App\Services;

use App\Enums\ProductTypeEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\LaptopSpec;
use App\Models\PhoneSpec;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Traits\ImageTrait;

class ProductVersionService extends Controller
{
    private Model $model;
    private $imageTrait;

    public function __construct(ProductVersion $productVersions, ImageTrait $imageTrait)
    {
        $this->model = $productVersions;
        $this->imageTrait = $imageTrait;
    }

    public function getList($products)
    {
        return DataTables::of(
            ProductVersion::select(ProductVersion::getInfo())
                ->where('product_id', $products->id)
                ->orderBy('created_at', 'desc')
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('name', function ($object) {
                return $object->config_name;
            })
            ->editColumn('status', function ($object) {
                if ($object->status == StatusEnum::ON) {
                    return StatusEnum::ON;
                }
                return StatusEnum::OFF;
            })
            ->editColumn('price', function ($object) {
                return number_format($object->final_price, 0, ',', '.') . '₫';
            })
            ->addColumn('actions', function ($object) {
                $products = Product::find($object->product_id);
                return [
                    'id' => $object->id,
                    'destroy' => '',
                    'edit' => route('admin.products.productsVersion.edit', [
                        'products' => $products,
                        'product_version' => $object->slug
                    ]),
                ];
            })
            ->make(true);
    }

    public function store($request, $products)
    {

        DB::beginTransaction();
        try {
            $product_id = $products->id;

            $product_version = ProductVersion::create([
                'product_id' => $product_id,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => Str::slug($request->description),
            ]);

            $product_version_id = $product_version->id;

            $category_product = CategoryProduct::where('id', $products->category_product_id)->first('slug');

            switch ($category_product->slug) {
                case ProductTypeEnum::LAPTOP:
                    LaptopSpec::create([
                        'product_id'          => $product_version_id,
                        'gpu'                 => $request->gpu,
                        'cpu'                 => $request->cpu,
                        'ram_size'            => $request->ram_size,
                        'ram_type'            => $request->ram_type,
                        'ram_slot'            => $request->ram_slot,
                        'storage_type'        => $request->storage_type,
                        'storage_size'        => $request->storage_size,
                        'display_size'        => $request->display_size,
                        'display_resolution'  => $request->display_resolution,
                        'display_technology'  => $request->display_technology,
                        'display_panel'       => $request->display_panel,
                        'refresh_rate'        => $request->refresh_rate,
                        'audio_technology'    => $request->audio_technology,
                        'memory_card_slot'    => $request->memory_card_slot,
                        'wifi'                => $request->wifi,
                        'bluetooth_version'   => $request->bluetooth_version,
                        'usb_ports'           => $request->usb_ports,
                        'dimension'           => $request->dimension,
                        'weight'              => $request->weight,
                        'material'            => $request->material,
                        'operating_system'    => $request->operating_system,
                        'webcam'              => $request->webcam,
                        'battery'             => $request->battery,
                        'keyboard_type'       => $request->keyboard_type,
                        'other_feature'       => $request->other_feature,
                        'security'            => $request->security,
                        'release_date'        => $request->release_date,
                    ]);
                    break;
                case ProductTypeEnum::PHONE:
                    PhoneSpec::create([
                        'product_id'             => $product_version_id,
                        'display_size'           => $request->display_size,
                        'display_type'           => $request->display_type,
                        'display_resolution'     => $request->display_resolution,
                        'display_refresh_rate'   => $request->display_refresh_rate,
                        'display_features'       => $request->display_features,
                        'rear_camera'            => $request->rear_camera,
                        'front_camera'           => $request->front_camera,
                        'camera_features'        => $request->camera_features,
                        'chipset'                => $request->chipset,
                        'gpu'                    => $request->gpu,
                        'nfc_support'            => $request->nfc_support,
                        'sim_type'               => $request->sim_type,
                        'network_support'        => $request->network_support,
                        'gps_support'            => $request->gps_support,
                        'ram_size'               => $request->ram_size,
                        'storage_size'           => $request->storage_size,
                        'battery_capacity'       => $request->battery_capacity,
                        'charging_port'          => $request->charging_port,
                        'charging_technology'    => $request->charging_technology,
                        'weight'                 => $request->weight,
                        'frame_material'         => $request->frame_material,
                        'dimension'              => $request->dimension,
                        'operating_system'       => $request->operating_system,
                        'water_dust_resistance'  => $request->water_dust_resistance,
                        'audio_technology'       => $request->audio_technology,
                        'fingerprint_sensor'     => $request->fingerprint_sensor,
                        'other_sensors'          => $request->other_sensors,
                        'wifi_technology'        => $request->wifi_technology,
                        'bluetooth_technology'   => $request->bluetooth_technology,
                        'release_date'           => $request->release_date,
                    ]);
                    break;
                case ProductTypeEnum::MOUSE:
                    break;
                case ProductTypeEnum::KEYBOARD:
                    break;
                case ProductTypeEnum::HEADPHONE:
                    break;
            }

            $nameConfig = "{$request->cpu} - {$request->ram_size} - {$request->storage_size}";

            $product_version->update([
                'config_name' => $nameConfig,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function update($request, $productVersion)
    {
        DB::beginTransaction();
        try {

            $products = Product::find($productVersion->product_id);

            $category_product = CategoryProduct::where('id', $products->category_product_id)->first('slug');

            $product_version_id = $productVersion->id;



            switch ($category_product->slug) {
                case ProductTypeEnum::LAPTOP:
                    LaptopSpec::where('product_id', $product_version_id)
                        ->update([
                            'gpu'                 => $request->gpu,
                            'cpu'                 => $request->cpu,
                            'ram_size'            => $request->ram_size,
                            'ram_type'            => $request->ram_type,
                            'ram_slot'            => $request->ram_slot,
                            'storage_type'        => $request->storage_type,
                            'storage_size'        => $request->storage_size,
                            'display_size'        => $request->display_size,
                            'display_resolution'  => $request->display_resolution,
                            'display_technology'  => $request->display_technology,
                            'display_panel'       => $request->display_panel,
                            'refresh_rate'        => $request->refresh_rate,
                            'audio_technology'    => $request->audio_technology,
                            'memory_card_slot'    => $request->memory_card_slot,
                            'wifi'                => $request->wifi,
                            'bluetooth_version'   => $request->bluetooth_version,
                            'usb_ports'           => $request->usb_ports,
                            'dimension'           => $request->dimension,
                            'weight'              => $request->weight,
                            'material'            => $request->material,
                            'operating_system'    => $request->operating_system,
                            'webcam'              => $request->webcam,
                            'battery'             => $request->battery,
                            'keyboard_type'       => $request->keyboard_type,
                            'other_feature'       => $request->other_feature,
                            'security'            => $request->security,
                            'release_date'        => $request->release_date,
                        ]);
                    break;
                case ProductTypeEnum::PHONE:
                    PhoneSpec::where('product_id', $product_version_id)
                        ->update([
                            'display_size'           => $request->display_size,
                            'display_type'           => $request->display_type,
                            'display_resolution'     => $request->display_resolution,
                            'display_refresh_rate'   => $request->display_refresh_rate,
                            'display_features'       => $request->display_features,
                            'rear_camera'            => $request->rear_camera,
                            'front_camera'           => $request->front_camera,
                            'camera_features'        => $request->camera_features,
                            'chipset'                => $request->chipset,
                            'gpu'                    => $request->gpu,
                            'nfc_support'            => $request->nfc_support,
                            'sim_type'               => $request->sim_type,
                            'network_support'        => $request->network_support,
                            'gps_support'            => $request->gps_support,
                            'ram_size'               => $request->ram_size,
                            'storage_size'           => $request->storage_size,
                            'battery_capacity'       => $request->battery_capacity,
                            'charging_port'          => $request->charging_port,
                            'charging_technology'    => $request->charging_technology,
                            'weight'                 => $request->weight,
                            'frame_material'         => $request->frame_material,
                            'dimension'              => $request->dimension,
                            'operating_system'       => $request->operating_system,
                            'water_dust_resistance'  => $request->water_dust_resistance,
                            'audio_technology'       => $request->audio_technology,
                            'fingerprint_sensor'     => $request->fingerprint_sensor,
                            'other_sensors'          => $request->other_sensors,
                            'wifi_technology'        => $request->wifi_technology,
                            'bluetooth_technology'   => $request->bluetooth_technology,
                            'release_date'           => $request->release_date,
                        ]);
                    break;
                case ProductTypeEnum::MOUSE:
                    break;
                case ProductTypeEnum::KEYBOARD:
                    break;
                case ProductTypeEnum::HEADPHONE:
                    break;
            }

            $nameConfig = "{$products->name} - {$request->cpu} - {$request->ram_size} - {$request->storage_size}";
            StockImportDetail::where('stock_import_id', $request->stock_import_id)->update(
                [
                    'final_price' => (int) preg_replace('/[^\d]/', '', $request->final_price),
                    'profit_rate'  => $request->profit_rate
                ]
            );
            // lấy id phiếu nhập sớm nhất nếu số lượng ở phiếu nhập đó = 0 tức là bán hết thì sẽ lấy id kế tiếp
            $stock_import_old_id = StockImportDetail::with('stockImport')
                ->where('product_version_id', $productVersion->id)
                ->where('stock_quantity', '>', '0')->min('stock_import_id');
            // lấy giá nhập tại phiếu nhập đó
            $stock_import = StockImport::with('stockImportDetails')->where('id', $stock_import_old_id)->first();
            ProductVersion::where('id', $productVersion->id)
                ->update([
                    'config_name' => $nameConfig,
                    'name' => $products->name,
                    'slug' => Str::slug($nameConfig),
                    'final_price' => $stock_import->stockImportDetails->first()->final_price,
                ]);

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
            $product_version = ProductVersion::findOrFail($request->id);
            $product_version->delete();
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
            ProductVersion::onlyTrashed()->forceDelete();
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
            ProductVersion::onlyTrashed()->restore();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
