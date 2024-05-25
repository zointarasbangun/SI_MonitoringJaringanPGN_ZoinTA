<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{

    protected $fillable = [
        'nama_server',
        'latitude',
        'longitude',
        'user_id',

    ];

    function users()
    {
        return $this-> hasMany(User::class,'server_id','id');
    }

    function logperbaikan()
    {
        return $this-> hasMany(logperbaikan::class,'server_id','id');
    }

}
