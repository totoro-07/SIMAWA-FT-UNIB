<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query builder dari model Prestasi
        $query = Prestasi::query();

        // Tambahkan logika pengurutan berdasarkan filter_date jika ada
        if ($request->has('filter_date')) {
            $query->orderBy('tanggal_pelaporan', $request->filter_date === 'oldest' ? 'asc' : 'desc');
        } else {
            $query->orderBy('tanggal_pelaporan', 'desc'); // Default urutan
        }

        // Lakukan paginasi pada hasil query
        $prestasis = $query->paginate(10);

        // Kirim data ke view
        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    // In PrestasiController.php
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'npm' => 'required|string|max:255',
            'nama_mahasiswa' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'nama_perlombaan' => 'required|string|max:255',
            'juara' => 'required|string|max:50',
            'tingkat_perlombaan' => 'required|string|max:100',
            'tanggal_pelaporan' => 'required|date',
            'sertifikat' => 'nullable|file|mimes:pdf,jpeg,png|max:2048', // Allow PDF, JPEG, and PNG files
        ]);

        // Save the prestasi data
        $prestasi = new Prestasi($validated);

        if ($request->hasFile('sertifikat')) {
            $file = $request->file('sertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('sertifikat', $filename);
            $prestasi->sertifikat = $filename;
        }

        $prestasi->status = 'pending'; // Set status as 'pending'
        $prestasi->save();

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil disimpan.');
    }

    public function show(Prestasi $prestasi)
    {
        return view('admin.prestasi.show', compact('prestasi'));
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'npm' => 'required|string|max:15',
            'nama_mahasiswa' => 'required|string|max:150',
            'program_studi' => 'required|string|max:100',
            'nama_perlombaan' => 'required|string|max:150',
            'juara' => 'required|string|max:50',
            'tingkat_perlombaan' => 'required|string|max:100',
            'tanggal_pelaporan' => 'required|date',
            'sertifikat' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
        ]);

        $prestasi->update($request->except('sertifikat'));

        // Memperbarui sertifikat jika ada
        if ($request->hasFile('sertifikat')) {
            if ($prestasi->sertifikat) {
                Storage::delete('sertifikat' . $prestasi->sertifikat);
            }

            $file = $request->file('sertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('sertifikat', $filename);
            $prestasi->sertifikat = $filename;
        }

        // Update status jika admin mengubahnya
        if ($request->has('status')) {
            $prestasi->status = $request->status;
        }

        $prestasi->save();

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->sertifikat) {
            Storage::delete('public/sertifikat/' . $prestasi->sertifikat);
        }

        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus!');
    }

    public function downloadPDF()
    {
        $prestasis = Prestasi::all(); // Ambil data yang akan dimasukkan ke dalam PDF

        $pdf = PDF::loadView('admin.prestasi.pdf', compact('prestasis')); // Membuat PDF dengan view
        return $pdf->download('prestasi.pdf'); // Mengunduh file PDF
    }
    public function verify(Prestasi $prestasi)
    {
        // Logika untuk memverifikasi prestasi, misalnya mengubah status menjadi "approved"
        $prestasi->status = 'approved'; // Misal, status diubah menjadi approved
        $prestasi->save();

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diverifikasi!');
    }
}
