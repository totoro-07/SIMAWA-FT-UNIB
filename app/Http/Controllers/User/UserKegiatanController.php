<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class UserKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        // Filter berdasarkan status, hanya tampilkan yang sudah 'approved' atau 'terverifikasi'
        $query->where('status', 'approved');

        // Filter berdasarkan tanggal jika ada
        if ($request->has('filter_date')) {
            $query->orderBy('tanggal_mulai', $request->filter_date === 'oldest' ? 'asc' : 'desc');
        } else {
            $query->orderBy('tanggal_mulai', 'desc');
        }

        // Ambil data dengan paginasi
        $kegiatan = $query->paginate(10);

        // Kirim data ke view
        return view('account.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        // Menampilkan formulir tambah kegiatan
        return view('account.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'penyelenggara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->nama_kegiatan = $validated['nama_kegiatan'];
        $kegiatan->jenis_kegiatan = $validated['jenis_kegiatan'];
        $kegiatan->lokasi = $validated['lokasi'];
        $kegiatan->tanggal_mulai = $validated['tanggal_mulai'];
        $kegiatan->tanggal_selesai = $validated['tanggal_selesai'];
        $kegiatan->penyelenggara = $validated['penyelenggara'];
        $kegiatan->deskripsi = $validated['deskripsi'];

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kegiatan_images', 'public');
            $kegiatan->gambar = $gambarPath;
        }

        $kegiatan->status = 'pending';
        $kegiatan->save();

        return redirect()->route('account.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan! Menunggu verifikasi.');
    }

}
