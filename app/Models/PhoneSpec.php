<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneSpec extends Model
{
    protected $fillable = [
        'product_id',
        'display_size',
        'display_type',
        'display_resolution',
        'display_refresh_rate',
        'display_features',
        'rear_camera',
        'front_camera',
        'camera_features',
        'chipset',
        'gpu',
        'nfc_support',
        'sim_type',
        'network_support',
        'gps_support',
        'ram_size',
        'storage_size',
        'battery_capacity',
        'charging_technology',
        'charging_port',
        'operating_system',
        'weight',
        'dimension',
        'frame_material',
        'water_dust_resistance',
        'audio_technology',
        'fingerprint_sensor',
        'other_sensors',
        'wifi_technology',
        'bluetooth_technology',
        'created_at',
        'updated_at',
    ];

    public function getInfo()
    {
        return [
            'product_id',
            'display_size',
            'display_type',
            'display_resolution',
            'display_refresh_rate',
            'display_features',
            'rear_camera',
            'front_camera',
            'camera_features',
            'chipset',
            'gpu',
            'nfc_support',
            'sim_type',
            'network_support',
            'gps_support',
            'ram_size',
            'storage_size',
            'battery_capacity',
            'charging_technology',
            'charging_port',
            'operating_system',
            'weight',
            'dimension',
            'frame_material',
            'water_dust_resistance',
            'audio_technology',
            'fingerprint_sensor',
            'other_sensors',
            'wifi_technology',
            'bluetooth_technology'
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function productVersions(){
        return $this->belongsTo(ProductVersion::class, 'product_id','id');
    }
}
