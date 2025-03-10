<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserProfileController extends Controller
{
    // Menampilkan profil pengguna yang sedang login
    public function show()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = auth()->user();

        // Menampilkan halaman profil
        return view('account.profile', compact('user'));  // Ganti 'profile' dengan 'user'
    }
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    // Pastikan password lama yang dimasukkan sesuai dengan yang ada di database
    if (!Hash::check($request->current_password, Auth::user()->password)) {
        return back()->withErrors(['current_password' => 'Password lama salah.']);
    }

    // Perbarui password pengguna
    Auth::user()->update([
        'password' => Hash::make($request->new_password),
    ]);

    return redirect()->route('account.profile')->with('success', 'Password berhasil diubah.');
}
}
