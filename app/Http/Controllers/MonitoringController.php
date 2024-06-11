<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Notifikasi;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function dataKlien()
    {
        // Mengambil semua pengguna dengan role 'klien' dan menghitung jumlah perangkat yang dimiliki
        $users = User::withCount('device')->where('role', 'klien')->get();

        return view('monitoring.klienlokasi', compact('users'));
    }


    public function dataServer()
    {
        // Ambil semua server dan hitung jumlah pengguna dengan peran 'klien' untuk setiap server
        $servers = Server::withCount([
            'users' => function ($query) {
                $query->where('role', 'klien');
            }
        ])->get();

        return view('monitoring.serverlokasi', compact('servers'));
    }

    public function dataMonitoring()
    {
        $perangkats = Device::whereHas('user', function ($query) {
            $query->where('role', 'klien');
        })->with('user')->get();

        foreach ($perangkats as $perangkat) {

            $perangkat->status = 'waiting';
        }

        return view('monitoring.perangkatlokasi', compact('perangkats'));
    }

    public function teknisidataKlien()
    {
        $users = User::withCount('device')->where('role', 'klien')->get();

        return view('monitoring.klienlokasi', compact('users'));
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

    public function kliendataMonitoring($id)
    {
        // Mengambil perangkat yang dimiliki oleh klien dengan ID yang diberikan
        $perangkat = Device::whereHas('user', function ($query) use ($id) {
            $query->where('id', $id)->where('role', 'klien');
        })->get();

        return view('monitoring.perangkatlokasi', compact('perangkat'));
    }

    public function tesPing($alamat_ip)
    {
        // $alamat_ip="google.com";

        exec("ping -n 1 " . $alamat_ip, $output, $result);

        // print_r($output);

        if ($result == 0)

            return true;
        else

            return false;
    }

    public function tesPingAjax(Request $request)
    {


        exec("ping -n 1 " . $request->ip, $output, $result);

        // print_r($output);

        if ($result == 0) {

            return true;
        } else {
            Notifikasi::create(['device_id' => $request->id, 'message' => 'perangkat tidak terhubung']);
            return false;
        }
    }

}
