<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logperbaikan extends Model
{
    protected $guarded = [
        'id',
    ];

    function user()
    {
        return $this-> belongsTo (User::class, 'user_id','id');
    }

    function server ()
    {
        return $this-> belongsTo (Server::class, 'server_id','id');
    }

    function device ()
    {
        return $this-> belongsTo (Device::class, 'device_id','id');
    }
}
