<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\logperbaikan;
use App\Models\Monitoring;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function app()
    {

    }
    public function dashboard()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $userId = $user->id;
            $role = $user->role;
            $data = User::whereNotIn('role', ['admin', 'teknisi'])->get();
            $device = Device::all();
            $teknisi = User::where('role', 'teknisi')->get();
            $klien = User::where('role', 'klien')->get();
            $server = Server::all();
            $devices = Device::where('user_id', $userId)->get();

            // Menyesuaikan tampilan berdasarkan peran pengguna
            if ($role == 'admin') {
                return view('dashboard.admindashboard', compact('data', 'device', 'teknisi', 'klien', 'server'));
            } elseif ($role == 'teknisi') {
                return view('dashboard.teknisidashboard', compact('data', 'device', 'teknisi', 'klien', 'server', 'userId', 'devices'));
            } elseif ($role == 'klien') {
                return redirect()->route('dashboardklien', ['id' => $userId]);
            } else {
                // Peran lainnya, Anda dapat menyesuaikan atau menangani kasus ini sesuai kebutuhan
                return view('dashboard', compact('data'));
            }
        }

        return redirect()->route('login'); // Jika tidak terautentikasi, redirect ke halaman login
    }


    public function dashboardklien($userId)
    {
        // Mengambil data perangkat yang dimiliki oleh pengguna (klien) dengan ID tertentu
        $data = Device::whereHas('user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
            ->get();

        // Mengambil data pengguna dengan peran 'klien'
        $user = User::where('role', 'klien')->get();
        $device = Device::get()->count();
        $teknisi = User::where('role', 'teknisi')->count();
        $klien = User::where('role', 'klien')->count();
        // Mengambil user yang sedang login
        $user = auth()->user();

        // Menghitung jumlah device yang terhubung ke user yang sedang login
        $deviceCount = $user->device()->count();

        // Mengembalikan view dengan data perangkat dan klien
        return view('dashboard.kliendashboard', compact('data', 'user', 'device', 'klien', 'teknisi', 'deviceCount'));
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




    public function editAkun($id)
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

    public function searchakun(Request $request)
    {
        $query = User::where('role', '!=', 'admin'); // Pastikan admin tidak termasuk

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                    ->orWhere('role', 'LIKE', $searchTerm);
            });
        }

        $user = $query->get(); // Gunakan variabel $users untuk mengirim hasil pencarian
        $server = Server::get();

        return view('account.dataAkun', compact('user', 'server')); // Pastikan 'users' adalah nama variabel yang dikirim ke view
    }


    public function searchklien(Request $request)
    {
        $query = User::query();

        // Lakukan join dengan tabel server
        $query->join('servers', 'users.server_id', '=', 'servers.id')
            ->where('users.role', 'klien');
        ; // Pastikan admin tidak termasuk

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                    ->orWhere('kontak', 'LIKE', $searchTerm)
                    ->orWhere('alamat', 'LIKE', $searchTerm)
                    ->orWhere('servers.nama_server', 'LIKE', $searchTerm);
            });
        }


        $data = $query->get();
        $server = Server::get();

        return view('klien.dataKlien', compact('data', 'server'));
    }

    public function searchserver(Request $request)
    {
        $query = Server::query();

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_server', 'LIKE', $searchTerm);
            });
        }


        $server = $query->get();

        return view('server.server', compact('server'));
    }

    public function searchdevice(Request $request)
    {
        $query = Device::query();
        $user = User::where('role', 'klien')->get();

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->where(function ($q) use ($searchTerm) {

                $q->where('nama_perangkat', 'LIKE', $searchTerm)->orWhere('ip_perangkat', 'LIKE', $searchTerm);
            });
        }

        $data = $query->get();

        return view('device.perangkat', compact('data', 'user'));
    }

    public function searchdetaildevice(Request $request)
    {
        $query = Device::query();

        // Dapatkan user_id dari request
        $userId = $request->input('user_id');

        if ($userId) {
            // Filter perangkat berdasarkan user_id
            $query->whereHas('user', function ($q) use ($userId) {
                $q->where('id', $userId);
            });
        }

        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';

            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_perangkat', 'LIKE', $searchTerm)
                    ->orWhere('ip_perangkat', 'LIKE', $searchTerm);
            });
        }

        $data = $query->get();

        return view('device.detailperangkat', compact('data'));
    }


    public function searchlog(Request $request)
    {
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');
        $user = Auth::user();
        $role = $user->role;

        // Mulai query logperbaikan
        $query = logperbaikan::with(['userlog', 'serverlog', 'devicelog']);

        if ($role === 'klien') {
            // Untuk klien, hanya menampilkan data yang berhubungan dengan akun klien tersebut
            $query->whereHas('userlog', function ($query) use ($user) {
                $query->where('id', $user->id)->where('role', 'klien');
            });
        } else {
            // Untuk admin dan teknisi, menampilkan semua data log yang sudah disetujui dan selesai
            $query->whereNotNull('foto');
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('userlog', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })->orWhereHas('serverlog', function ($q) use ($search) {
                    $q->where('nama_server', 'LIKE', '%' . $search . '%');
                })->orWhereHas('devicelog', function ($q) use ($search) {
                    $q->where('nama_perangkat', 'LIKE', '%' . $search . '%');
                })->orWhere('statusadmin', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%')
                    ->orWhere('teknisi', 'LIKE', '%' . $search . '%')
                    ->orWhere('foto', 'LIKE', '%' . $search . '%');
            });
        }

        // Tambahkan kondisi untuk filter tanggal
        if ($cariTanggalAwal && $cariTanggalAkhir) {
            $query->whereBetween('tanggal', [$cariTanggalAwal, $cariTanggalAkhir]);
        } elseif ($cariTanggalAwal) {
            $query->where('tanggal', '>=', $cariTanggalAwal);
        } elseif ($cariTanggalAkhir) {
            $query->where('tanggal', '<=', $cariTanggalAkhir);
        }

        // Eksekusi query dan dapatkan hasilnya
        $log = $query->get();

        // Dapatkan data user dan server untuk form pencarian
        $user = User::whereNot('role', 'admin')->get();
        $server = Server::all();

        return view('logperbaikan.datalog', compact('log', 'user', 'server'));
    }


    public function kliensearchlog(Request $request)
    {
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');

        // Dapatkan user yang sedang login
        $loggedInUser = Auth::user();

        // Mulai query logperbaikan
        $query = logperbaikan::with(['userlog', 'serverlog', 'devicelog'])
            ->whereHas('userlog', function ($query) use ($loggedInUser) {
                $query->where('id', $loggedInUser->id)->where('role', 'klien');
            })
            ->whereNotNull('foto');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('userlog', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })->orWhereHas('serverlog', function ($q) use ($search) {
                    $q->where('nama_server', 'LIKE', '%' . $search . '%');
                })->orWhereHas('devicelog', function ($q) use ($search) {
                    $q->where('nama_perangkat', 'LIKE', '%' . $search . '%');
                })->orWhere('statusadmin', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%')
                    ->orWhere('teknisi', 'LIKE', '%' . $search . '%')
                    ->orWhere('foto', 'LIKE', '%' . $search . '%');
            });
        }

        // Tambahkan kondisi untuk filter tanggal
        if ($cariTanggalAwal && $cariTanggalAkhir) {
            $query->whereBetween('tanggal', [$cariTanggalAwal, $cariTanggalAkhir]);
        } elseif ($cariTanggalAwal) {
            $query->where('tanggal', '>=', $cariTanggalAwal);
        } elseif ($cariTanggalAkhir) {
            $query->where('tanggal', '<=', $cariTanggalAkhir);
        }

        // Eksekusi query dan dapatkan hasilnya
        $log = $query->get();

        // Dapatkan data user dan server untuk form pencarian
        $user = User::whereNot('role', 'admin')->get();
        $server = Server::all();

        return view('logperbaikan.datalog', compact('log', 'user', 'server'));
    }


    public function searchstatuslog(Request $request)
    {
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');
        $namaTeknisi = Auth::user()->name;
        // Mulai query logperbaikan
        $query = logperbaikan::with(['userlog', 'serverlog', 'devicelog'])
            ->whereNull('foto'); // Menambahkan kondisi untuk hanya mengambil yang sedang diproses

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('userlog', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })->orWhereHas('serverlog', function ($q) use ($search) {
                    $q->where('nama_server', 'LIKE', '%' . $search . '%');
                })->orWhereHas('devicelog', function ($q) use ($search) {
                    $q->where('nama_perangkat', 'LIKE', '%' . $search . '%');
                })->orWhere('statusadmin', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%')
                    ->orWhere('teknisi', 'LIKE', '%' . $search . '%');
            });
        }

        // Tambahkan kondisi untuk filter tanggal
        if ($cariTanggalAwal && $cariTanggalAkhir) {
            $query->whereBetween('tanggal', [$cariTanggalAwal, $cariTanggalAkhir]);
        } elseif ($cariTanggalAwal) {
            $query->where('tanggal', '>=', $cariTanggalAwal);
        } elseif ($cariTanggalAkhir) {
            $query->where('tanggal', '<=', $cariTanggalAkhir);
        }

        // Eksekusi query dan dapatkan hasilnya
        $log = $query->get();

        // Dapatkan data user dan server untuk form pencarian
        $user = User::where('role', '!=', 'admin')->get();
        $server = Server::all();

        return view('logperbaikan.statuslog', compact('log', 'user', 'server', 'namaTeknisi'));
    }

    public function searchriwayatlog(Request $request)
    {
        $namaTeknisi = Auth::user()->name;
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');

        // Mulai query logperbaikan
        $query = logperbaikan::with(['userlog', 'serverlog', 'devicelog'])
            ->whereNotNull('foto')->where('teknisi', $namaTeknisi);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('userlog', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })->orWhereHas('serverlog', function ($q) use ($search) {
                    $q->where('nama_server', 'LIKE', '%' . $search . '%');
                })->orWhereHas('devicelog', function ($q) use ($search) {
                    $q->where('nama_perangkat', 'LIKE', '%' . $search . '%');
                })->orWhere('statusadmin', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%')
                    ->orWhere('teknisi', 'LIKE', '%' . $search . '%')
                    ->orWhere('foto', 'LIKE', '%' . $search . '%');
            });
        }

        // Tambahkan kondisi untuk filter tanggal
        if ($cariTanggalAwal && $cariTanggalAkhir) {
            $query->whereBetween('tanggal', [$cariTanggalAwal, $cariTanggalAkhir]);
        } elseif ($cariTanggalAwal) {
            $query->where('tanggal', '>=', $cariTanggalAwal);
        } elseif ($cariTanggalAkhir) {
            $query->where('tanggal', '<=', $cariTanggalAkhir);
        }

        // Eksekusi query dan dapatkan hasilnya
        $log = $query->get();

        // Dapatkan data user dan server untuk form pencarian
        $user = User::whereNot('role', 'admin')->get();
        $server = Server::all();

        return view('logperbaikan.riwayatlog', compact('log', 'user', 'server', 'namaTeknisi'));
    }

}
