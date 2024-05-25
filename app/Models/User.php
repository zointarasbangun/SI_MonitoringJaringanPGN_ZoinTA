<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'kontak',
        'tahun_langganan',
        'server_id',
        'latitude',
        'longitude',
        'role',
        'status',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'server_id' => 'integer',
    ];

    function server ()
    {
        return $this-> belongsTo (Server::class, 'server_id','id');
    }

    function device ()
    {
        return $this->hasMany (Device::class,'user_id','id');
    }

    function logperbaikan()
    {
        return $this->hasMany(logperbaikan::class, 'user_id','id');
    }
}
