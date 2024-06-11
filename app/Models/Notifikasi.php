<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $guarded = [
        'id',
    ];

    function devices ()
    {
        return $this-> belongsTo (Device::class, 'device_id','id');
    }
}
