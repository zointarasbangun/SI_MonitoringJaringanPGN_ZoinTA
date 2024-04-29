<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;
use App\Models\User;

class ServerController extends Controller
{
    public function dataServer()
    {

        $server = Server::get();

        return view('server.server', compact('server'));
    }

    public function store (Request $request)
    {
        $validatedData = $request->validate([
            'nama_server'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
        ]);

        $serverData=[
            'nama_server' => $validatedData['nama_server'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],

        ];

        $server = Server::create($serverData);

        // Redirect ke halaman dataAkun setelah penyimpanan berhasil
        return redirect()->route('dataServer');
    }

    public function edit ($id)
    {
        $server = Server::findOrFail($id);

        // Mengembalikan view 'admin.editAkun' dan menyertakan data user
        return view('server.editserver', compact('server'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_server'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
        ]);

        $serverData=[
            'nama_server' => $validatedData['nama_server'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
        ];

        $affectedRows = Server::whereId($id)->update($serverData);

        if ($affectedRows == 0) {
            return redirect()->back()->with('error', 'Tidak ada perubahan yang disimpan.');
        }

        return redirect()->route('dataServer')->with('success', 'Data Server diperbarui.');
    }

    public function destroy (string $id)
    {
        $data = Server::findOrFail($id);
        $data -> delete();

        return redirect()->route('dataServer');
    }

    public function teknisidataServer()
    {

        $server = Server::get();

        return view('server.server', compact('server'));
    }
}
