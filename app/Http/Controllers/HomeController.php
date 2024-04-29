<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard()
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            $data = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
            // Menyesuaikan tampilan berdasarkan peran pengguna
            if ($role == 'admin') {
                return view('dashboard.admindashboard', compact('data'));
            } elseif ($role == 'teknisi') {
                return view('dashboard.teknisidashboard', compact('data'));
            } elseif ($role == 'klien') {
                return view('dashboard.kliendashboard', compact('data'));
            } else {
                // Peran lainnya, Anda dapat menyesuaikan atau menangani kasus ini sesuai kebutuhan
                return view('dashboard', compact('data'));
            }
        }

        // Jika tidak terotentikasi, mungkin Anda ingin menangani sesuatu di sini, seperti menampilkan halaman login.
        return redirect('/login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'kontak' => 'nullable',
            'alamat' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'tahun_langganan' => 'nullable',
            'server_id' => 'nullable',
            'role' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('photos', 'public');
            $validatedData['image'] = $photoPath;
        }

        // Buat array untuk data pengguna baru
        $userData = [
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
        ];

        // Tambahkan data lainnya ke dalam array data pengguna baru
        $userData['kontak'] = $validatedData['kontak'] ?? null;
        $userData['alamat'] = $validatedData['alamat'] ?? null;
        $userData['tahun_langganan'] = $validatedData['tahun_langganan'] ?? null;
        $userData['latitude'] = $validatedData['latitude'] ?? null;
        $userData['longitude'] = $validatedData['longitude'] ?? null;
        $userData['server_id'] = $validatedData['server_id'] ?? null;
        $userData['role'] = $validatedData['role'] ?? null;
        $userData['image'] = $validatedData['image'] ?? null;

        // Membuat pengguna baru
        $user = User::create($userData);
        // Redirect ke halaman dataAkun setelah penyimpanan berhasil
        return redirect()->route('dataAkun');
    }




    public function editAkun(Request $request, $id)
    {
        // Cek apakah user dengan ID yang diberikan ada dalam database
        $user = User::findOrFail($id);

        $server = Server::get();

        // Mengembalikan view 'admin.editAkun' dan menyertakan data user
        return view('account.editAkun', compact('user', 'server'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6',
            'kontak' => 'nullable',
            'alamat' => 'nullable',
            'tahun_langganan' => 'nullable',
            'server_id' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'status' => 'nullable',
            'role' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = User::findOrFail($id);

        // Jika ada file gambar yang diunggah, proses dan simpan
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Simpan gambar baru
            $photoPath = $request->file('image')->store('photos', 'public');
            $validatedData['image'] = $photoPath;
        }

        if (empty($request->password)) {
            unset($validatedData['password']);
        }

        if (empty($request->status)) {
            unset($validatedData['status']);
        }

        // Update data pengguna
        $user->update($validatedData);

        // Jika ada perubahan pada password, hash dan simpan
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('dataAkun')->with('success', 'Data pengguna diperbarui.');
    }


    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('dataAkun');
    }

    public function tambahAkun()
    {
        $data = User::get();
        return view('account.tambahAkun', compact('data'));
    }
    public function dataAkun()
    {

        $user = User::whereNot('role', 'admin')->get();

        $server = Server::get();

        // Mengembalikan view 'admin.editAkun' dan menyertakan data user
        return view('account.dataAkun', compact('user', 'server'));
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

        if ($result == 0)

            return true;
        else

            return false;
    }
}
