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

    function user()
    {
        return $this-> hasMany(User::class,'server_id','id');
    }

}
