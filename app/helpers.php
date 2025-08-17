<?php

use App\Enums\OrderStatusEnum;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CategoryProduct;
use App\Models\Order;
use App\Models\StockExport;
use App\Models\StockImport;
use App\Models\StockImportDetail;
use Illuminate\Support\Facades\Auth;


if (!function_exists('formatPriceToVND')) {
    function formatPriceToVND($price)
    {
        return number_format($price, 0, ',', '.') . ' ₫';
    }
}
if (!function_exists('getDataBrandLaptop')) {
    function getDataBrandLaptop()
    {
        return Brand::with('modelSeries')->orderBy('name', 'asc')->get();
    }
}

if (!function_exists('getDataBrandLaptop')) {
    function getDataBrandLaptop()
    {
        return Brand::with('modelSeries')->orderBy('name', 'asc')->get();
    }
}

if (!function_exists('getDataBrandPhone')) {
    function getDataBrandPhone()
    {
        return Brand::with('modelSeries')->orderBy('name', 'asc')->get();
    }
}

if (!function_exists('checkCountCart')) {
    function checkCountCart($customer_id)
    {
        $cartIds = Cart::where('customer_id', $customer_id)->pluck('id');

        return CartItem::whereIn('cart_id', $cartIds)->count();
    }
}

if (!function_exists('checkOrder')) {
    function checkOrder()
    {
        return Order::where('status', OrderStatusEnum::PENDING)->count();
    }
}

if (!function_exists('checkStockExport')) {
    function checkStockExport()
    {
        return StockExport::where('status', OrderStatusEnum::PROCCESSING)->count();
    }
}

if (!function_exists('getLaptopSpecs')) {
    function getLaptopSpecs($product)
    {
        return  [
            'gpu' => $product->laptopSpecs->gpu ?? null,
            'cpu' => $product->laptopSpecs->cpu ?? null,
            'ram_size' => $product->laptopSpecs->ram_size ?? null,
            'ram_type' => $product->laptopSpecs->ram_type ?? null,
            'ram_slot' => $product->laptopSpecs->ram_slot ?? null,
            'storage_type' => $product->laptopSpecs->storage_type ?? null,
            'storage_size' => $product->laptopSpecs->storage_size ?? null,
            'display_size' => $product->laptopSpecs->display_size ?? null,
            'display_resolution' => $product->laptopSpecs->display_resolution ?? null,
            'display_technology' => $product->laptopSpecs->display_technology ?? null,
            'display_panel' => $product->laptopSpecs->display_panel ?? null,
            'refresh_rate' => $product->laptopSpecs->refresh_rate ?? null,
            'audio_technology' => $product->laptopSpecs->audio_technology ?? null,
            'memory_card_slot' => $product->laptopSpecs->memory_card_slot ?? null,
            'wifi' => $product->laptopSpecs->wifi ?? null,
            'bluetooth_version' => $product->laptopSpecs->bluetooth_version ?? null,
            'usb_ports' => $product->laptopSpecs->usb_ports ?? null,
            'dimension' => $product->laptopSpecs->dimension ?? null,
            'weight' => $product->laptopSpecs->weight ?? null,
            'material' => $product->laptopSpecs->material ?? null,
            'operating_system' => $product->laptopSpecs->operating_system ?? null,
            'webcam' => $product->laptopSpecs->webcam ?? null,
            'battery' => $product->laptopSpecs->battery ?? null,
            'keyboard_type' => $product->laptopSpecs->keyboard_type ?? null,
            'other_feature' => $product->laptopSpecs->other_feature ?? null,
            'security' => $product->laptopSpecs->security ?? null,
            'release_date' => $product->laptopSpecs->release_date ?? null,
        ];
    }
}
if (!function_exists('getPhoneSpecs')) {
    function getPhoneSpecs($product)
    {
        return [
            'display_size' => $product->phoneSpecs->display_size ?? null,
            'display_type' => $product->phoneSpecs->display_type ?? null,
            'display_resolution' => $product->phoneSpecs->display_resolution ?? null,
            'display_refresh_rate' => $product->phoneSpecs->display_refresh_rate ?? null,
            'display_features' => $product->phoneSpecs->display_features ?? null,
            'rear_camera' => $product->phoneSpecs->rear_camera ?? null,
            'front_camera' => $product->phoneSpecs->front_camera ?? null,
            'camera_features' => $product->phoneSpecs->camera_features ?? null,
            'chipset' => $product->phoneSpecs->chipset ?? null,
            'gpu' => $product->phoneSpecs->gpu ?? null,
            'nfc_support' => $product->phoneSpecs->nfc_support ?? null,
            'sim_type' => $product->phoneSpecs->sim_type ?? null,
            'network_support' => $product->phoneSpecs->network_support ?? null,
            'gps_support' => $product->phoneSpecs->gps_support ?? null,
            'ram_size' => $product->phoneSpecs->ram_size ?? null,
            'storage_size' => $product->phoneSpecs->storage_size ?? null,
            'battery_capacity' => $product->phoneSpecs->battery_capacity ?? null,
            'charging_technology' => $product->phoneSpecs->charging_technology ?? null,
            'charging_port' => $product->phoneSpecs->charging_port ?? null,
            'operating_system' => $product->phoneSpecs->operating_system ?? null,
            'weight' => $product->phoneSpecs->weight ?? null,
            'dimension' => $product->phoneSpecs->dimension ?? null,
            'frame_material' => $product->phoneSpecs->frame_material ?? null,
            'water_dust_resistance' => $product->phoneSpecs->water_dust_resistance ?? null,
            'audio_technology' => $product->phoneSpecs->audio_technology ?? null,
            'fingerprint_sensor' => $product->phoneSpecs->fingerprint_sensor ?? null,
            'other_sensors' => $product->phoneSpecs->other_sensors ?? null,
            'wifi_technology' => $product->phoneSpecs->wifi_technology ?? null,
            'release_date' => $product->laptopSpecs->release_date ?? null,
            'bluetooth_technology' => $product->phoneSpecs->bluetooth_technology ?? null,
        ];
    }
}

if (!function_exists('get_laptop_specs')) {
    function get_laptop_specs($product)
    {
        return  [
            'gpu' => $product->gpu ?? null,
            'cpu' => $product->cpu ?? null,
            'ram_size' => $product->ram_size ?? null,
            'ram_type' => $product->ram_type ?? null,
            'ram_slot' => $product->ram_slot ?? null,
            'storage_type' => $product->storage_type ?? null,
            'storage_size' => $product->storage_size ?? null,
            'display_size' => $product->display_size ?? null,
            'display_resolution' => $product->display_resolution ?? null,
            'display_technology' => $product->display_technology ?? null,
            'display_panel' => $product->display_panel ?? null,
            'refresh_rate' => $product->refresh_rate ?? null,
            'audio_technology' => $product->audio_technology ?? null,
            'memory_card_slot' => $product->memory_card_slot ?? null,
            'wifi' => $product->wifi ?? null,
            'bluetooth_version' => $product->bluetooth_version ?? null,
            'usb_ports' => $product->usb_ports ?? null,
            'dimension' => $product->dimension ?? null,
            'weight' => $product->weight ?? null,
            'material' => $product->material ?? null,
            'operating_system' => $product->operating_system ?? null,
            'webcam' => $product->webcam ?? null,
            'battery' => $product->battery ?? null,
            'keyboard_type' => $product->keyboard_type ?? null,
            'other_feature' => $product->other_feature ?? null,
            'security' => $product->security ?? null,
            'release_date' => $product->release_date ?? null,
        ];
    }
}
if (!function_exists('get_phone_specs')) {
    function get_phone_specs($product)
    {
        return [
            'display_size' => $product->display_size ?? null,
            'display_type' => $product->display_type ?? null,
            'display_resolution' => $product->display_resolution ?? null,
            'display_refresh_rate' => $product->display_refresh_rate ?? null,
            'display_features' => $product->display_features ?? null,
            'rear_camera' => $product->rear_camera ?? null,
            'front_camera' => $product->front_camera ?? null,
            'camera_features' => $product->camera_features ?? null,
            'chipset' => $product->chipset ?? null,
            'gpu' => $product->gpu ?? null,
            'nfc_support' => $product->nfc_support ?? null,
            'sim_type' => $product->sim_type ?? null,
            'network_support' => $product->network_support ?? null,
            'gps_support' => $product->gps_support ?? null,
            'ram_size' => $product->ram_size ?? null,
            'storage_size' => $product->storage_size ?? null,
            'battery_capacity' => $product->battery_capacity ?? null,
            'charging_technology' => $product->charging_technology ?? null,
            'charging_port' => $product->charging_port ?? null,
            'operating_system' => $product->operating_system ?? null,
            'weight' => $product->weight ?? null,
            'dimension' => $product->dimension ?? null,
            'frame_material' => $product->frame_material ?? null,
            'water_dust_resistance' => $product->water_dust_resistance ?? null,
            'audio_technology' => $product->audio_technology ?? null,
            'fingerprint_sensor' => $product->fingerprint_sensor ?? null,
            'other_sensors' => $product->other_sensors ?? null,
            'wifi_technology' => $product->wifi_technology ?? null,
            'release_date' => $product->release_date ?? null,
            'bluetooth_technology' => $product->bluetooth_technology ?? null,
        ];
    }
}
