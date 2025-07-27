<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberRole extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'role_id',
        'member_id',
    ];

    public function getInfo()
    {
        return [
            'id',
            'role_id',
            'member_id',
            'created_at',
            'updated_at'
        ];
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-y H:i:s');
    }

    public function members(){
        return $this->belongsTo(Role::class, 'member_id');
    }
}
