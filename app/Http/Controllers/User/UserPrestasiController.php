<?php

// UserPrestasiController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class UserPrestasiController extends Controller
{
    // Menampilkan form input prestasi
    public function create()
    {
        $user = auth()->user();
        return view('account.prestasi.create', compact('user'));
    }

    // Menyimpan prestasi yang diinput oleh User
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'npm' => 'required|max:255',
            'nama_mahasiswa' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'nama_perlombaan' => 'required|string|max:255',
            'juara' => 'required|string|max:50',
            'tingkat_perlombaan' => 'required|string|max:100',
            'tanggal_pelaporan' => 'required|date',
            'sertifikat' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
        ]);

        // Simpan data prestasi ke database
        $prestasi = new Prestasi($request->all());

        // Upload sertifikat jika ada
        if ($request->hasFile('sertifikat')) {
            $file = $request->file('sertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('sertifikat', $filename);
            $prestasi->sertifikat = $filename;
        }

        $prestasi->status = 'pending'; // Set status awal sebagai 'pending'
        $prestasi->save();

        // Redirect dengan pesan sukses
        return redirect()->route('account.prestasi')->with('success', 'Prestasi berhasil dilaporkan.');
    }

    // Menampilkan daftar prestasi yang diajukan oleh user
    public function index(Request $request)
    {
        // Memulai query untuk model Prestasi
        $query = Prestasi::where('status', 'approved'); // Hanya ambil yang statusnya 'approved'

        // Tambahkan logika pengurutan berdasarkan tanggal pelaporan jika filter_date ada
        if ($request->has('filter_date')) {
            $query->orderBy('tanggal_pelaporan', $request->filter_date === 'oldest' ? 'asc' : 'desc');
        } else {
            $query->orderBy('tanggal_pelaporan', 'desc'); // Default urutan
        }

        // Lakukan paginasi pada hasil query
        $prestasis = $query->paginate(10); // Sesuaikan jumlah item per halaman

        // Kirim data ke view
        return view('account.prestasi.index', compact('prestasis'));
    }

    public function edit($id)
    {
        // Ambil data prestasi berdasarkan id
        $prestasi = Prestasi::findOrFail($id);

        // Kirim data prestasi ke view
        return view('account.prestasi.edit', compact('prestasi'));
    }
}
