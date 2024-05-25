<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = [
        'id',
    ];

    // protected $fillable = [
    //     'nama_perangkat',
    //     'latitude',
    //     'longitude',
    //     'user_id',
    //     'ip_perangkat',
    // ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    function user()
    {
        return $this-> belongsTo (User::class, 'user_id','id');
    }

    function logperbaikan()
    {
        return $this-> hasMany(logperbaikan::class,'device_id','id');
    }
}
