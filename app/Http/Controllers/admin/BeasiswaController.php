<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class BeasiswaController extends Controller
{
    // Menampilkan daftar beasiswa dengan pagination dan filter berdasarkan tanggal
    public function index(Request $request)
    {
        // Mulai query builder dari model Beasiswa
        $query = Beasiswa::query();

        // Tambahkan logika pengurutan berdasarkan filter_date jika ada
        if ($request->has('filter_date')) {
            $query->orderBy('created_at', $request->filter_date === 'oldest' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc'); // Default urutan
        }

        // Lakukan paginasi pada hasil query
        $beasiswas = $query->paginate(10);

        // Jika ada parameter 'detail' pada query string, kita tampilkan data detail
        $detailBeasiswa = null;
        if ($request->has('detail')) {
            $detailBeasiswa = Beasiswa::find($request->detail);
        }

        // Kirim data ke view
        return view('admin.beasiswa.index', compact('beasiswas', 'detailBeasiswa'));
    }

    // Menampilkan form untuk menambah beasiswa
    public function create()
    {
        return view('admin.beasiswa.create');
    }

    // Menyimpan data beasiswa baru
    public function store(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'npm' => 'required|string|max:15',
            'nama_penerima' => 'required|string|max:150',
            'prodi' => 'required|string|max:100',
            'semester' => 'required|string|max:10',
            'nama_beasiswa' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'tanggal_menerima' => 'required|date', // Validasi tanggal_menerima
            'bukti_beasiswa' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
        ]);

        // Simpan data beasiswa baru
        $beasiswa = new Beasiswa($validated);

        // Proses file bukti beasiswa jika ada
        if ($request->hasFile('bukti_beasiswa')) {
            $file = $request->file('bukti_beasiswa');
            $filename = time() . '_beasiswa_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('berkas_beasiswa', $filename, 'public'); // Simpan di disk 'public'
            $beasiswa->bukti_beasiswa = $filePath; // Simpan path ke kolom bukti_beasiswa
        }

        // Proses file bukti penerima jika ada
        if ($request->hasFile('bukti_penerima')) {
            $file = $request->file('bukti_penerima');
            $filename = time() . '_penerima_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('berkas_penerima', $filename, 'public'); // Simpan di disk 'public'
            $beasiswa->bukti_penerima = $filePath; // Simpan path ke kolom bukti_penerima
        }

        // Set status verifikasi default
        $beasiswa->status_verifikasi = 'belum_verifikasi';
        $beasiswa->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.beasiswa.index')->with('success', 'Data beasiswa berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data beasiswa
    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id); // Temukan beasiswa berdasarkan ID
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    // Memperbarui data beasiswa
    public function update(Request $request, Beasiswa $beasiswa)
    {
        // Validasi inputan
        $validated = $request->validate([
            'npm' => 'required|string|max:15',
            'nama_penerima' => 'required|string|max:150',
            'prodi' => 'required|string|max:100',
            'semester' => 'required|string|max:10',
            'nama_beasiswa' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'tanggal_menerima' => 'nullable|date',
            'bukti_beasiswa' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
            'status_verifikasi' => 'required|in:belum_verifikasi,terverifikasi',
        ]);

        // Update data beasiswa
        $beasiswa->update($validated);

        // Memperbarui tanggal menerima jika ada input
        if ($request->hasFile('bukti_beasiswa')) {
            $file = $request->file('bukti_beasiswa');
            $filename = time() . '_beasiswa_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('berkas_beasiswa', $filename, 'public'); // Simpan di disk 'public'
            $beasiswa->bukti_beasiswa = $filePath; // Simpan path ke kolom bukti_beasiswa
        }

        // Proses file bukti penerima jika ada
        if ($request->hasFile('bukti_penerima')) {
            $file = $request->file('bukti_penerima');
            $filename = time() . '_penerima_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('berkas_penerima', $filename, 'public'); // Simpan di disk 'public'
            $beasiswa->bukti_penerima = $filePath; // Simpan path ke kolom bukti_penerima
        }

        // Simpan perubahan ke database
        $beasiswa->save();

        return redirect()->route('admin.beasiswa.index')->with('success', 'Data beasiswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan id (primary key)
        $beasiswa = Beasiswa::findOrFail($id);

        // Hapus data beasiswa
        $beasiswa->delete();

        // Redirect kembali ke daftar beasiswa
        return redirect()->route('admin.beasiswa.index')->with('success', 'Data beasiswa berhasil dihapus');
    }

    // Mendownload data beasiswa dalam format PDF
    public function downloadPDF()
    {
        $beasiswas = Beasiswa::all();
        $pdf = PDF::loadView('admin.beasiswa.pdf', compact('beasiswas'));

        return $pdf->download('data_beasiswa.pdf');
    }

    // Menampilkan detail data beasiswa berdasarkan ID
    public function show(Beasiswa $beasiswa)
    {
        return view('admin.beasiswa.show', compact('beasiswa'));
    }

    // Memverifikasi data beasiswa
    public function verifikasi(Beasiswa $beasiswa)
    {
        // Ubah status verifikasi menjadi 'terverifikasi'
        $beasiswa->status_verifikasi = 'terverifikasi';
        $beasiswa->save();

        return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa berhasil diverifikasi');
    }
}
