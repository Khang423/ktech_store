<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagDetail extends Model
{
    use SoftDeletes;
    protected $fillable  = [
        'id',
        'tag_id',
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];

    public static function getInfo()
    {
        return [
            'id',
            'tag_id',
            'name',
            'slug',
            'created_at',
            'updated_at'
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

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
