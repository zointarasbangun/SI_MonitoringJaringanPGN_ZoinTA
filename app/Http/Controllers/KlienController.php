<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KlienController extends Controller
{
    public function dataKlien()
    {

        $data = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::get();

        return view('klien.dataKlien', compact('data', 'server'));
    }

    public function tambahKlien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'kontak' => 'nullable',
            'alamat' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'tahun_langganan' => 'nullable',
            'server_id' => 'nullable',
            'role' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toJson();
            return redirect()->back()->with('errors', $errors)->withInput();
        }

        $validatedData = $validator->validated();

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

        // Memeriksa keberadaan kunci sebelum mengaksesnya
        if (isset($validatedData['kontak'])) {
            $userData['kontak'] = $validatedData['kontak'];
        }

        if (isset($validatedData['alamat'])) {
            $userData['alamat'] = $validatedData['alamat'];
        }

        if (isset($validatedData['tahun_langganan'])) {
            $userData['tahun_langganan'] = $validatedData['tahun_langganan'];
        }

        if (isset($validatedData['latitude'])) {
            $userData['latitude'] = $validatedData['latitude'];
        }

        if (isset($validatedData['longitude'])) {
            $userData['longitude'] = $validatedData['longitude'];
        }

        if (isset($validatedData['server_id'])) {
            $userData['server_id'] = $validatedData['server_id'];
        }

        if (isset($validatedData['role'])) {
            $userData['role'] = $validatedData['role'];
        }

        if (isset($validatedData['image'])) {
            $userData['image'] = $validatedData['image'];
        }

        // Membuat pengguna baru
        $user = User::create($userData);
        // Redirect ke halaman dataAkun setelah penyimpanan berhasil
        return redirect()->route('dataKlien')->with('success', 'Klien berhasil ditambahkan.');
    }

    public function editKlien(Request $request, $id)
    {
        // Cek apakah user dengan ID yang diberikan ada dalam database
        $user = User::findOrFail($id);

        $server = Server::get();

        // Mengembalikan view 'admin.editAkun' dan menyertakan data user
        return view('klien.editKlien', compact('user', 'server'));
    }

    public function updateKlien(Request $request, $id)
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

        return redirect()->route('dataKlien')->with('success', 'Data pengguna diperbarui.');
    }


    public function destroyklien(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('dataKlien')->with('success', 'Klien berhasil dihapus.');
    }

    public function teknisidataKlien()
    {
        $data = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::get();

        return view('klien.dataKlien', compact('data', 'server'));
    }

    public function detailklien($id)
    {
        $data = User::whereHas('server', function ($query) use ($id) {
            $query->where('id', $id);
        })
            ->get();

        // Mengambil data pengguna dengan peran 'klien'
        $user = User::where('role', 'klien')->get();
        $server = Server::get();

        // Mengembalikan view dengan data perangkat dan klien
        return view('klien.detailklien', compact('data', 'user', 'server'));
    }

    public function teknisidetailklien($id)
    {
        $data = User::whereHas('server', function ($query) use ($id) {
            $query->where('id', $id);
        })
            ->get();

        // Mengambil data pengguna dengan peran 'klien'
        $user = User::where('role', 'klien')->get();

        // Mengembalikan view dengan data perangkat dan klien
        return view('klien.detailklien', compact('data', 'user'));
    }
}
