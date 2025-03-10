<?php

use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\UserBeasiswaController;
use App\Http\Controllers\User\UserKegiatanController;
use App\Http\Controllers\User\UserPrestasiController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaPublicController;
// Route untuk halaman depan
Route::get('/', function () {
    // Jika user sudah login, redirect ke dashboard
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('account.dashboard');
    }
    return view('welcome');
});
Route::get('/', [BeritaPublicController::class, 'index'])->name('home');

// Routing untuk User
Route::group(['prefix' => 'account'], function () {

    // Guest middleware untuk login dan registrasi
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('register', [LoginController::class, 'processRegister'])->name('account.register.process');
        Route::get('forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
        Route::post('forgot-password', [LoginController::class, 'processForgotPassword'])->name('password.update');
    });

    // Auth middleware untuk pengguna yang sudah login
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::post('logout', [LoginController::class, 'logout'])->name('account.logout'); // Logout menggunakan POST
        Route::get('profil', [UserProfileController::class, 'show'])->name('account.profile');
        Route::post('password/update', [UserProfileController::class, 'updatePassword'])->name('account.password.update');

        Route::get('prestasi', [UserPrestasiController::class, 'index'])->name('account.prestasi');

        Route::get('prestasi/create', [UserPrestasiController::class, 'create'])->name('account.prestasi.create');
        Route::get('prestasi/{prestasi}/edit', [UserPrestasiController::class, 'edit'])->name('account.prestasi.edit');
        Route::post('prestasi', [UserPrestasiController::class, 'store'])->name('account.prestasi.store'); // Ensure this is a POST method for storing data

        Route::get('beasiswa', [UserBeasiswaController::class, 'index'])->name('account.beasiswa.index');
        Route::get('beasiswa/create', [UserBeasiswaController::class, 'create'])->name('account.beasiswa.create');
        Route::post('beasiswa/store', [UserBeasiswaController::class, 'store'])->name('account.beasiswa.store');

        Route::get('kegiatan', [UserKegiatanController::class, 'index'])->name('account.kegiatan.index');
        Route::get('kegiatan/create', [UserKegiatanController::class, 'create'])->name('account.kegiatan.create');
        Route::get('kegiatan/{kegiatan}/edit', [UserKegiatanController::class, 'edit'])->name('account.kegiatan.edit');
        Route::post('kegiatan', [UserKegiatanController::class, 'store'])->name('account.kegiatan.store');
    });

});

Route::group(['prefix' => 'admin'], function () {

    // Group untuk login admin, hanya untuk yang belum login
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('login', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
        Route::get('register', [AdminLoginController::class, 'showRegisterForm'])->name('admin.register');
        Route::post('register', [AdminLoginController::class, 'register'])->name('admin.register.submit');
        Route::get('reset', [AdminLoginController::class, 'showResetForm'])->name('admin.request');
        Route::post('reset', [AdminLoginController::class, 'resetPassword'])->name('admin.update');

    });

    // Group untuk halaman admin yang hanya bisa diakses oleh yang sudah login
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('profile', [ProfileController::class, 'profile'])->name('admin.profile');
        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');

        // Update Password
        Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('account.password.update');
        // Routing untuk prestasi admin
        Route::resource('prestasi', PrestasiController::class, ['names' => 'admin.prestasi', 'except' => ['show']]);
        Route::get('prestasi/{prestasi}/verify', [PrestasiController::class, 'verify'])->name('admin.prestasi.verify');
        Route::get('prestasi/download', [PrestasiController::class, 'downloadPDF'])->name('admin.prestasi.download');
        

        // Routing untuk beasiswa admin
        Route::resource('beasiswa', BeasiswaController::class, ['names' => 'admin.beasiswa', 'except' => ['show']]);
        Route::get('/beasiswa/download', [BeasiswaController::class, 'downloadPDF'])->name('admin.beasiswa.download');        

        
        // Routing untuk kegiatan admin
        Route::resource('kegiatan', KegiatanController::class, ['names' => 'admin.kegiatan', 'except' => ['show']]);
        Route::get('/kegiatan/download', [KegiatanController::class, 'downloadPDF'])->name('admin.kegiatan.download');


        // Route untuk menampilkan daftar berita
        Route::get('berita', [BeritaController::class, 'index'])->name('admin.berita.index');

        // Route untuk form tambah berita
        Route::get('berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');

        // Route untuk menyimpan berita
        Route::post('berita', [BeritaController::class, 'store'])->name('admin.berita.store');
        // Route untuk menampilkan detail berita
        Route::get('berita/{id}', [BeritaController::class, 'show'])->name('admin.berita.show');
        // Routing untuk admin (berita)
        Route::resource('berita', BeritaController::class, ['names' => 'admin.berita', 'except' => ['show']]);

        // Rute untuk form edit berita
        Route::get('berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');

        // Rute untuk menyimpan update berita
        Route::put('berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
        Route::get('laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
        Route::get('laporan/download', [LaporanController::class, 'download'])->name('admin.laporan.download');

    });

});

// Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
// Route::get('/admin/laporan/download', [LaporanController::class, 'download'])->name('admin.laporan.download');

