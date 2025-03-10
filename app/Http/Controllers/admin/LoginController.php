<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    // Proses autentikasi login
    public function authenticate(Request $request)
    {
        // Validasi input
        $rules = [
            'nip' => 'nullable|string',
            'npm' => 'nullable|string',
            'password' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.login')->withInput()->withErrors($validator);
        }

        // Cek apakah login menggunakan NIP atau NPM
        if ($request->nip) {
            // Menggunakan model User untuk login
            $user = User::where('nip', $request->nip)->first();
        } else {
            return redirect()->route('admin.login')->with('error', 'NIP diperlukan.');
        }

        // Cek apakah user ditemukan dan password valid
        if ($user && Hash::check($request->password, $user->password)) {
            // Pastikan menggunakan guard 'admin'
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'NIP atau password salah.');
        }
    }

    // Logout admin
    public function logout()
    {
        Auth::guard('admin')->logout(); // Logout guard admin
        session()->flush(); // Hapus semua data sesi
        return redirect()->route('admin.login');
    }

    // Menampilkan halaman register admin
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // Proses pendaftaran admin baru
    public function register(Request $request)
    {
        // Validasi input yang diperlukan
        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string|unique:users,nip', // Pastikan NIP unik di tabel users
            'password' => 'required|string|min:8|confirmed', // Validasi password
        ]);

        // Menyimpan admin baru ke dalam database
        $user = User::create([ // Assign the created user to $user
            'name' => $request->name,
            'nip' => $request->nip, // Pastikan admin mengisi NIP
            'role' => 'admin', // Secara otomatis role adalah 'admin'
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // Periksa apakah user berhasil disimpan
        if ($user) { // Check if $user is defined
            return redirect()->route('admin.login')->with('success', 'Akun admin berhasil dibuat.');
        } else {
            return redirect()->route('admin.register')->with('error', 'Terjadi kesalahan saat membuat akun.');
        }
    }

    // Menampilkan halaman reset password
    public function showResetForm()
    {
        return view('admin.reset');
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'nip' => 'required|exists:users,nip',
            'password' => 'required|confirmed|min:8',
        ]);

        // Cari admin berdasarkan NIP
        $admin = User::where('nip', $request->nip)->where('role', 'admin')->first();

        // Periksa apakah admin ditemukan
        if ($admin) {
            $admin->password = Hash::make($request->password); // Enkripsi password baru
            $admin->save(); // Simpan password baru

            return redirect()->route('admin.login')->with('success', 'Password berhasil diatur ulang.');
        }

        return back()->withErrors(['nip' => 'NIP tidak ditemukan.']);
    }
}
