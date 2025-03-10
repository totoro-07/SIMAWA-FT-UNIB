<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $prestasi = Berita::where('kategori', 'prestasi')->get();
        $beasiswa = Berita::where('kategori', 'beasiswa')->get();
        $kegiatan = Berita::where('kategori', 'kegiatan')->get();

        return view('admin.berita.index', compact('prestasi', 'beasiswa', 'kegiatan'));
    }

    // Menampilkan form untuk membuat berita baru
    public function create()
    {
        return view('admin.berita.create'); // Form untuk menambahkan berita
    }

    // Menyimpan berita baru ke dalam database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'konten' => 'required',
            'image' => 'nullable|image',
            'link' => 'nullable|url',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('public/images') : null;

        // Simpan berita dengan kategori yang dipilih
        Berita::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'konten' => $request->konten,
            'image' => $imagePath,
            'link' => $request->link,  // Simpan link
            'tanggal' => now(),
        ]);

        return redirect()->route('admin.berita.index');
    }

    // Menampilkan detail berita
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    // Menampilkan form edit berita
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    // Memperbarui berita
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'kategori' => 'required',
            'image' => 'nullable|image',
            'tanggal' => 'required|date',
            'link' => 'nullable|url',
        ]);

        $berita = Berita::findOrFail($id);

        $berita->update($request->only('judul', 'konten', 'kategori', 'tanggal','link'));

        if ($request->hasFile('image')) {
            $berita->image = $request->file('image')->store('berita_images', 'public');
            $berita->save();
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    // Menghapus berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}

