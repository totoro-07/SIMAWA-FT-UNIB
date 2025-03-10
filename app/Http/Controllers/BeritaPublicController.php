<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaPublicController extends Controller
{
    // Menampilkan berita pada halaman publik
    public function index()
    {
        $prestasi = Berita::where('kategori', 'prestasi')->get();
        $beasiswa = Berita::where('kategori', 'beasiswa')->get();
        $kegiatan = Berita::where('kategori', 'kegiatan')->get();

        return view('welcome', compact('prestasi', 'beasiswa', 'kegiatan'));
    }
}
