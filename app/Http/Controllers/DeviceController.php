<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    protected $telegram;

    public function __construct(TelegramService $telegram)
    {
        $this->telegram = $telegram;
    }
    public function dataDevice()
    {
        $data = Device::get();
        $user = User::where('role', 'klien')->get();

        foreach ($data as $perangkat) {
            $perangkat->status = 'waiting';
        }

        return view('device.perangkat', compact('data', 'user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perangkat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'ip_perangkat' => 'required|string'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toJson();
            return redirect()->back()->with('errors', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        $deviceData = [
            'nama_perangkat' => $validatedData['nama_perangkat'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'user_id' => $validatedData['user_id'],
            'ip_perangkat' => $validatedData['ip_perangkat']
        ];

        $device = Device::create($deviceData);


        // Redirect ke halaman dataAkun setelah penyimpanan berhasil
        return redirect()->route('dataDevice')->with('success', 'Perangkat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);

        $user = User::where('role', 'klien')->get();
        // Mengembalikan view 'admin.editAkun' dan menyertakan data user
        return view('device.editdevice', compact('device', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_perangkat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'ip_perangkat' => 'required'
        ]);

        $deviceData = [
            'nama_perangkat' => $validatedData['nama_perangkat'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'user_id' => $validatedData['user_id'],
            'ip_perangkat' => $validatedData['ip_perangkat'],
        ];

        $affectedRows = Device::whereId($id)->update($deviceData);

        if ($affectedRows == 0) {
            return redirect()->back()->with('error', 'Tidak ada perubahan yang disimpan.');
        }

        return redirect()->route('dataDevice')->with('success', 'Data Server diperbarui.');
    }

    public function destroy(string $id)
    {
        $data = Device::findOrFail($id);
        $data->delete();

        return redirect()->route('dataDevice')->with('success', 'Perangkat berhasil dihapus.');
    }

    public function teknisidataDevice()
    {
        // Mendapatkan data klien berdasarkan ID pengguna (user)
        $data = Device::get();
        $user = User::where('role', 'klien')->get();

        foreach ($data as $perangkat) {
            //tesping
            // $hasil_test_ping = $this->tesPing($perangkat->ip_perangkat);
            //masukkan hasil ke dalam array
            $perangkat->status = 'waiting';
        }

        return view('device.perangkat', compact('data', 'user'));
    }

    public function teknisidetailDevice($userId)
    {
        // Mengambil data perangkat yang dimiliki oleh pengguna (klien) dengan ID tertentu
        $data = Device::whereHas('user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
            ->get();

        // Mengambil data pengguna dengan peran 'klien'
        $user = User::where('role', 'klien')->get();

        // Mengembalikan view dengan data perangkat dan klien
        return view('device.detailperangkat', compact('data', 'user'));
    }

    public function detailDevice($userId)
    {
        // Mengambil data perangkat yang dimiliki oleh pengguna (klien) dengan ID tertentu
        $data = Device::whereHas('user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
            ->with('user') // Memuat data pengguna terkait dengan setiap perangkat
            ->get();


        // Mengambil data pengguna dengan peran 'klien'
        $user = User::where('role', 'klien')->get();

        // Mengembalikan view dengan data perangkat dan klien
        return view('device.detailperangkat', compact('data', 'user'));
    }

    public function kliendataDevice($userId)
    {
        $data = Device::whereHas('user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
            ->get();
        $user = User::where('role', 'klien')->get();

        foreach ($data as $perangkat) {

            $perangkat->status = 'waiting';
        }

        return view('device.perangkat', compact('data', 'user'));
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

        if ($result == 0) {
            return true;
        } else {
            $device = Device::with('user')->find($request->id);

            if ($device) {
                $notifikasi = Notifikasi::create([
                    'device_id' => $device->id,
                    'message' => 'perangkat tidak terhubung'
                ]);

                // Kirim notifikasi ke Telegram
                $namaPerangkat = $device->nama_perangkat;
                $namaKlien = $device->user->name;
                $pesan = 'perangkat tidak terhubung';

                $message = "Nama Perangkat: {$namaPerangkat}\nNama Klien: {$namaKlien}\nPesan: {$pesan}";
                $this->telegram->sendMessage($message);

                return false;
            } else {
                return false;
            }
        }

    }
}
