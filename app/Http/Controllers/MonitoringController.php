<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function dataKlien()
    {
        $user = User::with(['device'])->where('role', 'klien')->get();

        return view('monitoring.klienlokasi', compact('user'));
    }

    public function dataServer()
    {
        // Ambil data server yang terkait dengan pengguna yang memiliki peran 'klien'
        $server = Server::whereHas('user', function ($query) {
            $query->where('role', 'klien');
        })->get();

        return view('monitoring.serverlokasi', compact('server'));
    }


    public function dataMonitoring()
    {
        $perangkat = Device::whereHas('user', function ($query) {
            $query->where('role', 'klien');
        })->get();

        return view('monitoring.perangkatlokasi', compact('perangkat'));
    }

    public function teknisidataKlien()
    {
        $user = User::with(['device'])->where('role', 'klien')->get();

        return view('monitoring.klienlokasi', compact('user'));
    }

    public function teknisidataServer()
    {
        // Ambil data server yang terkait dengan pengguna yang memiliki peran 'klien'
        $server = Server::whereHas('user', function ($query) {
            $query->where('role', 'klien');
        })->get();

        return view('monitoring.serverlokasi', compact('server'));
    }

    public function teknisidataMonitoring()
    {
        $perangkat = Device::whereHas('user', function ($query) {
            $query->where('role', 'klien');
        })->get();

        return view('monitoring.perangkatlokasi', compact('perangkat'));
    }
}
