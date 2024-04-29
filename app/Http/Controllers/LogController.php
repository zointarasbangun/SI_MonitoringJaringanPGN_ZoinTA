<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function datalog()
    {

        $data = User::whereNot('role', 'admin')->get();
        $server = Server::get();
        $device = Device::get();

        return view('logperbaikan.datalog', compact('data', 'server', 'device'));
    }

    public function teknisidatalog()
    {

        $data = User::whereNot('role', 'admin')->get();
        $server = Server::get();
        $device = Device::get();

        return view('logperbaikan.datalog', compact('data', 'server', 'device'));
    }
}
