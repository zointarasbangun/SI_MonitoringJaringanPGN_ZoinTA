<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class logperbaikan extends Model
{
    public $table = "logperbaikan";

    protected $guarded = [
        'id',
    ];

    public static function getEnumValues($field)
    {
        $table = with(new static)->getTable();
        $type = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'")[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }



    function userlog()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function serverlog()
    {
        return $this->belongsTo(Server::class, 'server_id', 'id');
    }

    function devicelog()
    {
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }
}
