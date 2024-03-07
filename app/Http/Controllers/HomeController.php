<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard()
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            $data = User::get();
            // Menyesuaikan tampilan berdasarkan peran pengguna
            if ($role == 'admin') {
                return view('dashboard.admindashboard', compact('data'));
            } elseif ($role == 'teknisi') {
                return view('dashboard.teknisidashboard');
            } elseif ($role == 'klien') {
                return view('dashboard.kliendashboard');
            } else {
                // Peran lainnya, Anda dapat menyesuaikan atau menangani kasus ini sesuai kebutuhan
                return view('dashboard', compact('data'));
            }
        }

        // Jika tidak terotentikasi, mungkin Anda ingin menangani sesuatu di sini, seperti menampilkan halaman login.
        return redirect('/login');
    }



    public function index()
    {

        $data = User::get();

        return view('index', compact('data'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;
        User::create($data);

        return redirect()->route('admin.index');
    }

    public function editAkun(Request $request, $id)
    {
        $data = User::find($id);

        return view('admin.editAkun', compact('data'));
    }
    public function editServer(Request $request, $id)
    {
        $data = User::find($id);

        return view('admin.editServer', compact('data'));
    }

    public function perangkat(){

        return view('admin.perangkat');
    }

    public function editKlien(Request $request, $id)
    {
        $data = User::find($id);

        return view('admin.editKlien', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'nullable',
            'role' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['role'] = $request->role;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);

        return redirect()->route('admin.index');
    }

    public function delete(Request $request, $id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('admin.index');
    }
    public function tambahAkun()
    {
        $data = User::get();
        return view('admin.tambahAkun', compact('data'));
    }
    public function dataAkun()
    {

        $data = User::get();

        return view('admin.dataAkun', compact('data'));
    }
    public function tambahKlien()
    {
        $data = User::get();
        return view('admin.tambahKlien', compact('data'));
    }
    public function dataKlien()
    {

        $data = User::get();

        return view('admin.dataKlien', compact('data'));
    }
    public function tambahServer()
    {
        $data = User::get();
        return view('admin.tambahServer', compact('data'));
    }
    public function dataServer()
    {

        $data = User::get();

        return view('admin.dataServer', compact('data'));
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
