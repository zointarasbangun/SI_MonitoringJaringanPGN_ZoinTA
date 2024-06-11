<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\Device;
use App\Models\logperbaikan;
use App\Models\LogPerbaikan as ModelsLogPerbaikan;
use App\Models\Server;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;


class LogController extends Controller
{
    public function datalog()
    {
        $user = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::all();
        $device = Device::all();
        $log = logperbaikan::whereNot('statusadmin', 'menunggu')->whereNotNull('foto')->get();

        $namaTeknisi = Auth::user()->name;

        return view('logperbaikan.datalog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }

    public function statuslog()
    {
        $namaTeknisi = Auth::user()->name;
        $user = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::all();
        $device = Device::all();
        $log = logperbaikan::where('statusadmin', 'menunggu')->get();

        return view('logperbaikan.statuslog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }

    public function approveLaporan($id)
    {
        // Temukan laporan berdasarkan ID
        $laporan = LogPerbaikan::find($id);

        // Lakukan validasi apakah laporan ditemukan
        if ($laporan) {
            // Ubah status laporan menjadi disetujui
            $laporan->statusadmin = 'disetujui';
            $laporan->save();

            // Kirim respons JSON dengan pesan sukses
            return response()->json(['message' => 'Laporan telah disetujui.']);
        } else {
            // Kirim respons JSON dengan pesan error jika laporan tidak ditemukan
            return response()->json(['message' => 'Laporan tidak ditemukan.'], 404);
        }
    }

    public function rejectLaporan($id)
    {
        // Temukan laporan berdasarkan ID
        $laporan = LogPerbaikan::find($id);

        // Lakukan validasi apakah laporan ditemukan
        if ($laporan) {
            // Ubah status laporan menjadi ditolak
            $laporan->statusadmin = 'ditolak';
            $laporan->save();

            // Kirim respons JSON dengan pesan sukses
            return response()->json(['message' => 'Laporan telah ditolak.']);
        } else {
            // Kirim respons JSON dengan pesan error jika laporan tidak ditemukan
            return response()->json(['message' => 'Laporan tidak ditemukan.'], 404);
        }
    }

    public function teknisidatalog()
    {
        $user = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::all();
        $device = Device::all();
        $log = logperbaikan::whereNot('statusadmin', 'menunggu')->whereNotNull('foto')->get();

        $namaTeknisi = Auth::user()->name;

        return view('logperbaikan.datalog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }

    public function teknisistatuslog()
    {
        $namaTeknisi = Auth::user()->name;
        $user = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::all();
        $device = Device::all();
        $log = logperbaikan::where(function ($query) {
            $query->whereNull('foto')
                ->orWhere(function ($query) {
                    $query->where('statusadmin', 'disetujui')
                        ->whereNull('foto');
                })
                ->orWhere(function ($query) {
                    $query->where('statusadmin', 'menunggu')
                        ->whereNotNull('foto');
                });
        })->where('teknisi', $namaTeknisi)
            ->get();


        return view('logperbaikan.statuslog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }

    public function teknisiaddlog(Request $request)
    {
        $validatedData = $request->validate([
            'teknisi' => 'required',
            'user_id' => 'nullable',
            'server_id' => 'nullable',
            'device_id' => 'nullable',
            'tanggal' => 'required|date',
            'judul' => 'nullable',
            'keterangan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Membuat instance LogPerbaikan baru dengan data yang divalidasi
        $logPerbaikan = new LogPerbaikan();
        $logPerbaikan->teknisi = $validatedData['teknisi'];
        $logPerbaikan->user_id = $validatedData['user_id'];
        $logPerbaikan->server_id = $validatedData['server_id'];
        $logPerbaikan->device_id = $validatedData['device_id'];
        $logPerbaikan->tanggal = $validatedData['tanggal'];
        $logPerbaikan->judul = $validatedData['judul'];
        $logPerbaikan->keterangan = $validatedData['keterangan'];

        // Jika terdapat file foto yang diunggah, simpan path-nya ke dalam kolom 'foto'
        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->store('photos', 'public');
            $logPerbaikan->foto = $photoPath;
        }

        // Simpan log perbaikan
        $logPerbaikan->save();

        return redirect()->route('teknisi.statuslog');
    }
    public function editlog($id)
    {
        $log = logperbaikan::findOrFail($id);
        $user = User::where('role', 'klien')->get();
        $server = Server::all();
        $device = Device::all();

        $namaTeknisi = Auth::user()->name;

        // Mengembalikan view 'admin.editAkun' dan menyertakan data user
        return view('logperbaikan.editlog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }

    public function updatelog($id)
    {
        // 1. Ambil data log berdasarkan ID
        $log = LogPerbaikan::findOrFail($id);

        // 2. Validasi data dari permintaan
        $validatedData = request()->validate([
            'teknisi' => 'required',
            'user_id' => 'required',
            'server_id' => 'required',
            'device_id' => 'required',
            'tanggal' => 'required|date',
            'judul' => 'nullable',
            'keterangan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        // 3. Lakukan pembaruan data log
        $log->update($validatedData);

        // 4. Simpan perubahan
        $log->save();

        // 5. Redirect pengguna ke halaman atau rute yang sesuai
        return redirect()->route('teknisi.statuslog')->with('success', 'Log berhasil diperbarui.');
    }

    public function teknisieditlog($id)
    {
        $log = logperbaikan::findOrFail($id);
        $user = User::where('role', 'klien')->get();
        $server = Server::all();
        $device = Device::all();

        $namaTeknisi = Auth::user()->name;

        // Mengembalikan view 'admin.editAkun' dan menyertakan data user
        return view('logperbaikan.editlog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }
    public function teknisiupdatelog($id)
    {
        // 1. Ambil data log berdasarkan ID
        $log = LogPerbaikan::findOrFail($id);

        // 2. Validasi data dari permintaan
        $validatedData = request()->validate([
            'teknisi' => 'required',
            'user_id' => 'required',
            'server_id' => 'required',
            'device_id' => 'required',
            'tanggal' => 'required|date',
            'judul' => 'nullable',
            'keterangan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        // 3. Lakukan pembaruan data log
        $log->update($validatedData);

        // 4. Simpan perubahan
        $log->save();

        // 5. Redirect pengguna ke halaman atau rute yang sesuai
        return redirect()->route('teknisi.statuslog')->with('success', 'Log berhasil diperbarui.');
    }

    public function deleteLog(string $id)
    {
        $data = logperbaikan::findOrFail($id);
        $data->delete();

        return redirect()->route('datalog');
    }
    public function teknisideleteLog(string $id)
    {
        $data = logperbaikan::findOrFail($id);
        $data->delete();

        return redirect()->route('teknisi.statuslog');
    }

    public function teknisiriwayatlog()
    {
        $namaTeknisi = Auth::user()->name;
        $user = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::all();
        $device = Device::all();
        $log = logperbaikan::whereNot('statusadmin', 'menunggu')->where('teknisi', $namaTeknisi)->get();

        return view('logperbaikan.riwayatlog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }

    public function getDevicesByClient(Request $request)
    {
        // Ambil ID klien dari permintaan
        $klienId = $request->input('user_id');

        // Query untuk mengambil daftar perangkat yang sesuai dengan klien yang dipilih
        $devices = Device::where('user_id', $klienId)->pluck('nama_perangkat', 'id');

        // Mengembalikan daftar perangkat sebagai respons JSON
        return response()->json($devices);
    }

    public function getServersByClient(Request $request)
    {
        // Ambil ID klien dari permintaan
        $klienId = $request->input('user_id');

        // Modifikasi query untuk mengambil daftar perangkat yang sesuai dengan klien yang dipilih
        $servers = Server::whereHas('user', function ($query) use ($klienId) {
            $query->where('id', $klienId);
        })->pluck('nama_server', 'id');

        // Mengembalikan daftar perangkat sebagai respons JSON
        return response()->json($servers);
    }

    public function kliendatalog($id)
    {
        $user = User::whereNot('role', 'admin')->whereNot('role', 'teknisi')->get();
        $server = Server::all();
        $device = Device::all();

        $log = logperbaikan::whereHas('userlog', function ($query) use ($id) {
            $query->where('id', $id)->where('role', 'klien');
        })->where('statusadmin', 'disetujui')
            ->whereNotNull('foto')
            ->get();

        $namaTeknisi = Auth::user()->name;

        return view('logperbaikan.datalog', compact('log', 'user', 'server', 'device', 'namaTeknisi'));
    }

    public function export_excel(Request $request)
    {
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');

        // Mulai query logperbaikan
        $query = LogPerbaikan::with(['userlog', 'serverlog', 'devicelog']);
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

        return Excel::download(new DataExport($log), 'datalogperbaikan.xlsx');
    }

    public function teknisiexport_excel(Request $request)
    {
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');

        // Mulai query logperbaikan
        $query = LogPerbaikan::with(['userlog', 'serverlog', 'devicelog']);
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

        return Excel::download(new DataExport($log), 'datalogperbaikan.xlsx');
    }

    public function export_pdf(Request $request)
    {
        $namaTeknisi = Auth::user()->name;
        $user = User::whereNotIn('role', ['admin', 'teknisi'])->get();
        $server = Server::all();
        $device = Device::all();
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');

        $query = LogPerbaikan::with(['userlog', 'serverlog', 'devicelog']);
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

        if ($cariTanggalAwal && $cariTanggalAkhir) {
            $query->whereBetween('tanggal', [$cariTanggalAwal, $cariTanggalAkhir]);
        } elseif ($cariTanggalAwal) {
            $query->where('tanggal', '>=', $cariTanggalAwal);
        } elseif ($cariTanggalAkhir) {
            $query->where('tanggal', '<=', $cariTanggalAkhir);
        }

        $log = $query->get();

        $pdf = PDF::loadView('downloads.pdf', compact('log'));

        return $pdf->download('datalog.pdf');
    }

    public function teknisiexport_pdf(Request $request)
    {
        $namaTeknisi = Auth::user()->name;
        $user = User::whereNotIn('role', ['admin', 'teknisi'])->get();
        $server = Server::all();
        $device = Device::all();
        $search = $request->input('search');
        $cariTanggalAwal = $request->input('cariTanggalAwal');
        $cariTanggalAkhir = $request->input('cariTanggalAkhir');

        $query = LogPerbaikan::with(['userlog', 'serverlog', 'devicelog'])->whereNot('statusadmin', 'menunggu')->where('teknisi', $namaTeknisi);
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

        if ($cariTanggalAwal && $cariTanggalAkhir) {
            $query->whereBetween('tanggal', [$cariTanggalAwal, $cariTanggalAkhir]);
        } elseif ($cariTanggalAwal) {
            $query->where('tanggal', '>=', $cariTanggalAwal);
        } elseif ($cariTanggalAkhir) {
            $query->where('tanggal', '<=', $cariTanggalAkhir);
        }

        $log = $query->get();

        $pdf = PDF::loadView('downloads.pdf', compact('log'));

        return $pdf->download('riwayatlog.pdf');
    }

}
