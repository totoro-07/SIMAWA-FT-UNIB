<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class UserBeasiswaController extends Controller
{
    // Menampilkan daftar beasiswa untuk user yang login
    public function index()
    {
        // Menampilkan beasiswa yang sudah terverifikasi
        $beasiswas = Beasiswa::where('status_verifikasi', 'terverifikasi')
            ->paginate(10);

        // Mengirim data ke view
        return view('account.beasiswa.index', compact('beasiswas'));
    }

    // Mengunduh data beasiswa dalam format PDF
    public function downloadPDF()
    {
        $beasiswas = Beasiswa::where('npm', auth()->user()->npm)->get();
        $pdf = PDF::loadView('account.beasiswa.pdf', compact('beasiswas'));

        return $pdf->download('beasiswa_saya.pdf');
    }
    public function create()
    {
        // Ambil data pengguna yang sedang login
        $user = auth()->user();

        // Kirim data pengguna ke view
        return view('account.beasiswa.create', compact('user'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'npm' => 'required|string|max:15',
            'nama_penerima' => 'required|string|max:150',
            'prodi' => 'required|string|max:100',
            'semester' => 'required|string|max:10',
            'nama_beasiswa' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'tanggal_menerima' => 'nullable|date', // Validasi tanggal (opsional)
            'bukti_beasiswa' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file
        ]);
    
        // Menyimpan file bukti beasiswa
        $buktiPath = $request->file('bukti_beasiswa')->store('bukti_beasiswa', 'public');
    
        // Simpan data beasiswa ke database
        Beasiswa::create([
            'npm' => $request->npm,
            'nama_penerima' => $request->nama_penerima,
            'prodi' => $request->prodi,
            'semester' => $request->semester,
            'nama_beasiswa' => $request->nama_beasiswa,
            'keterangan' => $request->keterangan,
            'bukti_beasiswa' => $buktiPath, // Simpan path file
            'tanggal_menerima' => $request->tanggal_menerima, // Menyimpan tanggal yang dimasukkan oleh pengguna
            'status_verifikasi' => 'belum_verifikasi', // Status awal adalah belum diverifikasi
        ]);
    
        return redirect()->route('account.beasiswa.index')->with('success', 'Pengajuan Beasiswa berhasil dikirim untuk verifikasi.');
    }

}
