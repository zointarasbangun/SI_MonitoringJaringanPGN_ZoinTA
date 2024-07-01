<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
        $user = User::where('id', $userId)->first();

        return view('profile.profile', compact('user'));
    }

    public function editprofile($id)
    {
        $user = User::findOrFail($id);

        return view('profile.editprofile', compact('user'));
    }

    public function updateprofile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = User::findOrFail($id);

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
        $user->update($validatedData);
        // Jika ada perubahan pada password, hash dan simpan
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('profileadmin')->with('success', 'Data pengguna diperbarui.');
    }

    public function profileteknisi()
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
        $user = User::where('id', $userId)->first();

        return view('profile.profile', compact('user'));
    }

    public function editprofileteknisi($id)
    {
        $user = User::findOrFail($id);

        return view('profile.editprofile', compact('user'));
    }

    public function updateprofileteknisi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = User::findOrFail($id);

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
        $user->update($validatedData);
        // Jika ada perubahan pada password, hash dan simpan
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('profileteknisi')->with('success', 'Data pengguna diperbarui.');
    }

    public function profileklien()
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
        $user = User::where('id', $userId)->first();

        return view('profile.profile', compact('user'));
    }

    public function editprofileklien($id)
    {
        $user = User::findOrFail($id);

        return view('profile.editprofile', compact('user'));
    }

    public function updateprofileklien(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6',
            'kontak' => 'nullable',
            'alamat' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = User::findOrFail($id);

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
        $user->update($validatedData);
        // Jika ada perubahan pada password, hash dan simpan
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('profileklien')->with('success', 'Data pengguna diperbarui.');
    }

    public function deleteImage(Request $request)
    {
        $user = Auth::user();

        if ($user->image) {
            Storage::delete('public/' . $user->image);
            $user->image = null;
            $user->save();
        }

        return redirect()->route('editprofileteknisi')->with('success', 'Foto profil berhasil dihapus.');
    }
}
