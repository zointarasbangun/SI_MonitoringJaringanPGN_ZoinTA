<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function notifikasi()
    {

        $notifikasi = Notifikasi::get();

        return view('notifikasi.notifikasi', compact('notifikasi'));
    }

    public function teknisinotifikasi()
    {

        $notifikasi = Notifikasi::get();

        return view('notifikasi.notifikasi', compact('notifikasi'));
    }

    public function kliennotifikasi()
    {
        $user = auth()->user();

        // Mengambil notifikasi untuk perangkat yang terhubung dengan pengguna yang sedang login
        $notifikasi = Notifikasi::whereHas('devices', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('notifikasi.notifikasi', compact('notifikasi'));
    }

}
