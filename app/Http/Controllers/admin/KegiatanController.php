<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        // Tambahkan logika pengurutan berdasarkan filter_date jika ada
        if ($request->has('filter_date')) {
            $query->orderBy('tanggal_mulai', $request->filter_date === 'oldest' ? 'asc' : 'desc');
        } else {
            $query->orderBy('tanggal_mulai', 'desc'); // Default urutan berdasarkan tanggal_mulai
        }

        // Lakukan paginasi pada hasil query
        $kegiatan = $query->paginate(10);

        // Kirim data ke view
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create', ['kegiatan' => new Kegiatan()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',  // Ganti tanggal menjadi tanggal_mulai
            'tanggal_selesai' => 'required|date',  // Ganti tanggal menjadi tanggal_selesai
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $kegiatan = new Kegiatan($validated);
        if ($request->hasFile('gambar')) {
            $kegiatan->gambar = $request->file('gambar')->store('uploads/kegiatan', 'public');
        }
        $kegiatan->save();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id); // Get the 'kegiatan' record from the database
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',  // Ganti tanggal menjadi tanggal_mulai
            'tanggal_selesai' => 'required|date',  // Ganti tanggal menjadi tanggal_selesai
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Temukan kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        // Perbarui kolom-kolom kegiatan
        $kegiatan->nama_kegiatan = $validated['nama_kegiatan'];
        $kegiatan->jenis_kegiatan = $validated['jenis_kegiatan'];
        $kegiatan->lokasi = $validated['lokasi'];
        $kegiatan->tanggal_mulai = $validated['tanggal_mulai'];  // Ganti tanggal menjadi tanggal_mulai
        $kegiatan->tanggal_selesai = $validated['tanggal_selesai'];  // Ganti tanggal menjadi tanggal_selesai
        $kegiatan->deskripsi = $validated['deskripsi'];

        // Jika ada gambar baru, simpan gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kegiatan->gambar) {
                Storage::delete('public/' . $kegiatan->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('kegiatan', 'public');
            $kegiatan->gambar = $gambarPath;
        }

        // Perbarui status kegiatan
        $kegiatan->status = $validated['status'];

        // Simpan perubahan
        $kegiatan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.kegiatan.index');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        // Hapus gambar jika ada
        if ($kegiatan->gambar) {
            Storage::delete('public/kegiatan/' . $kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index');
    }

    public function downloadPDF()
    {
        $kegiatan = Kegiatan::all();
        $pdf = PDF::loadView('admin.kegiatan.pdf', compact('kegiatan'));

        return $pdf->download('data_kegiatan.pdf');
    }

    public function approve(Kegiatan $kegiatan)
    {
        $kegiatan->status = 'approved';
        $kegiatan->save();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan telah diverifikasi!');
    }

    public function reject(Kegiatan $kegiatan)
    {
        $kegiatan->status = 'rejected';
        $kegiatan->save();

        return redirect()->route('admin.kegiatan.index')->with('error', 'Kegiatan ditolak!');
    }
}
