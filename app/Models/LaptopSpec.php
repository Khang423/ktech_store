<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaptopSpec extends Model
{
    protected $fillable = [
        'product_id',
        'gpu',
        'cpu',
        'ram_size',
        'ram_type',
        'storage_type',
        'storage_size',
        'display_size',
        'display_resolution',
        'display_technology',
        'display_panel',
        'refresh_rate',
        'audio_technology',
        'memory_card_slot',
        'wifi',
        'bluetooth_version',
        'dimension',
        'weight',
        'material',
        'operating_system',
        'webcam',
        'battery',
        'keyboard_type',
        'other_feature',
        'security',
        'release_date',
        'created_at',
        'updated_at'
    ];

    public function get_info()
    {
        return [
            'product_id',
            'gpu',
            'cpu',
            'ram_size',
            'ram_type',
            'storage_type',
            'storage_size',
            'display_size',
            'display_resolution',
            'display_technolory',
            'display_panel',
            'refresh_rate',
            'audio_technology',
            'memory_card_slot',
            'wifi',
            'bluetooth_version',
            'usb_ports',
            'dimensions',
            'weight',
            'material',
            'operating_system',
            'webcam',
            'battery',
            'keyboard_type',
            'other_feature',
            'security',
            'created_at',
            'updated_at'
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
    public function productVersions()
    {
        return $this->belongsTo(ProductVersion::class, 'id', 'product_id');
    }
}
