<?php

namespace App\Http\Requests\Admin\product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'profit_rate' => 'required',
            'final_price' => 'required',
            'import_price' => 'string|required',
            'category_product_id' => 'string|required',
            'category_product_detail_id' => 'string|required',
            'brand_id' => 'string|required',
            'audio_technology_laptop' => 'string|nullable',
            'audio_technology_phone' => 'string|nullable',
            'battery' => 'string|nullable',
            'battery_capacity' => 'string|nullable',
            'bluetooth_technology' => 'string|nullable',
            'bluetooth_version' => 'string|nullable',
            'camera_features' => 'string|nullable',
            'charging_port' => 'string|nullable',
            'charging_technology' => 'string|nullable',
            'chipset' => 'string|nullable',
            'cpu' => 'string|nullable',
            'dimension' => 'string|nullable',
            'display_features' => 'string|nullable',
            'display_panel' => 'string|nullable',
            'display_refresh_rate' => 'string|nullable',
            'display_resolution_laptop' => 'string|nullable',
            'display_resolution_phone' => 'string|nullable',
            'display_size_laptop' => 'string|nullable',
            'display_size_phone' => 'string|nullable',
            'display_technology' => 'string|nullable',
            'display_type' => 'string|nullable',
            'fingerprint_sensor' => 'string|nullable',
            'frame_material' => 'string|nullable',
            'front_camera' => 'string|nullable',
            'gpu_laptop' => 'string|nullable',
            'gpu_phone' => 'string|nullable',
            'gps_support' => 'string|nullable',
            'keyboard_type' => 'string|nullable',
            'material' => 'string|nullable',
            'memory_card_slot' => 'string|nullable',
            'network_support' => 'string|nullable',
            'nfc_support' => 'string|nullable',
            'operating_system_laptop' => 'string|nullable',
            'operating_system_phone' => 'string|nullable',
            'other_feature' => 'string|nullable',
            'other_sensors' => 'string|nullable',
            'ram_size_laptop' => 'string|nullable',
            'ram_size_phone' => 'string|nullable',
            'ram_type' => 'string|nullable',
            'rear_camera' => 'string|nullable',
            'refresh_rate' => 'string|nullable',
            'security' => 'string|nullable',
            'sim_type' => 'string|nullable',
            'storage_size_laptop' => 'string|nullable',
            'storage_size_phone' => 'string|nullable',
            'storage_type' => 'string|nullable',
            'usb_ports' => 'string|nullable',
            'water_dust_resistance' => 'string|nullable',
            'webcam' => 'string|nullable',
            'weight_laptop' => 'string|nullable',
            'weight_phone' => 'string|nullable',
            'wifi_laptop' => 'string|nullable',
            'wifi_technology' => 'string|nullable'
        ];
    }
}
