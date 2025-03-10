<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil berita untuk kategori 'prestasi', 'beasiswa', dan 'kegiatan' tanpa memeriksa login
        $prestasi = Berita::where('kategori', 'prestasi')->latest()->take(3)->get();
        $beasiswa = Berita::where('kategori', 'beasiswa')->latest()->take(3)->get();
        $kegiatan = Berita::where('kategori', 'kegiatan')->latest()->take(3)->get();

        // Tampilkan halaman dashboard
        return view('account.dashboard', compact('prestasi', 'beasiswa', 'kegiatan'));
    }
}
