<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('account.login');
    }

    // Proses login
    public function authenticate(Request $request)
    {
        // Tentukan aturan validasi untuk login
        $rules = [
            'npm' => 'nullable', // Validasi NPM untuk mahasiswa
            'nip' => 'nullable|numeric', // Validasi NIP untuk admin
            'password' => 'required|min:5',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

        // Periksa apakah NPM atau NIP yang digunakan untuk login
        if ($request->npm) {
            // Login menggunakan NPM (untuk mahasiswa)
            $user = User::where('npm', $request->npm)->first();
        } elseif ($request->nip) {
            // Login menggunakan NIP (untuk admin)
            $user = User::where('nip', $request->nip)->first();
        } else {
            return redirect()->route('account.login')->with('error', 'NPM atau NIP diperlukan.');
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Login berhasil
            return redirect()->route('account.dashboard');
        } else {
            return redirect()->route('account.login')->with('error', 'NPM/NIP atau password salah.');
        }
    }

    // Menampilkan halaman registrasi
    public function register()
    {
        return view('account.register');
    }

    public function processRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'nullable|required_if:role,user|unique:users,npm', // Validasi npm jika role = user
            'nip' => 'nullable|required_if:role,admin|unique:users,nip', // Validasi nip jika role = admin
            'prodi' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
        ]);

        // Tentukan role berdasarkan npm atau nip
        $role = null;
        if ($validated['npm']) {
            $role = 'user'; // Jika ada npm, maka role = user
        } elseif ($validated['nip']) {
            $role = 'admin'; // Jika ada nip, maka role = admin
        }

        // Jika tidak ada npm atau nip, Anda bisa mengembalikan error atau mengatur role secara default
        if (!$role) {
            return redirect()->route('account.register')->with('error', 'NPM atau NIP diperlukan.');
        }

        // Simpan data ke database
        User::create([
            'name' => $validated['name'],
            'prodi' => $validated['prodi'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
            'npm' => $role === 'user' ? $validated['npm'] : null,
            'nip' => $role === 'admin' ? $validated['nip'] : null,
        ]);

        return redirect()->route('account.login')->with('success', 'Registrasi berhasil.');
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function showForgotPasswordForm()
    {
        return view('account.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        // Validasi NPM dan password baru
        $validated = $request->validate([
            'npm' => 'required|exists:users,npm', // Pastikan NPM ada di database
            'password' => 'required|string|min:8|confirmed', // Validasi dengan konfirmasi password
        ]);        

        // Cari pengguna berdasarkan NPM
        $user = User::where('npm', $validated['npm'])->first();

        if ($user) {
            // Update password pengguna
            $user->password = Hash::make($validated['password']);
            $user->save();

            return redirect()->route('account.login')->with('success', 'Password berhasil direset.');
        } else {
            return back()->with('error', 'NPM tidak ditemukan.');
        }
    }
}
