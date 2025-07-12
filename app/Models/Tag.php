<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $fillable  = [
        'id',
        'name',
        'slug',
    ];

    public static function getInfo()
    {
        return [
            'id',
            'name',
            'slug',
            'created_at',
            'updated_at',
            'deleted_at'
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i:s d-m-Y');
    }
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i:s d-m-Y');
    }

    public function tagDetails() {
        return $this->hasMany(TagDetail::class);
    }
}
