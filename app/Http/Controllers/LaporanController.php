<?php

namespace App\Http\Controllers;

use App\Exports\BeasiswaExport;
use App\Exports\PrestasiExport;
use App\Exports\KegiatanExport;
use App\Models\Beasiswa;
use App\Models\Prestasi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan halaman form download laporan
        return view('admin.laporan.index');
    }

    public function download(Request $request)
    {
        // Ambil parameter dari request, jika tidak ada maka kirim null
        $tahun_menerima = $request->input('year_received', null);
        $tahun_melapor = $request->input('year_reported', null);
        $filter_tanggal = $request->input('filter_date', null);
        $download_type = $request->input('download_type', 'beasiswa'); // Default adalah 'beasiswa'

        // Cek jenis laporan yang dipilih
        if ($download_type == 'beasiswa') {
            return $this->downloadBeasiswa($tahun_menerima, $filter_tanggal);
        } elseif ($download_type == 'prestasi') {
            return $this->downloadPrestasi($tahun_menerima, $filter_tanggal);
        } elseif ($download_type == 'kegiatan') {
            return $this->downloadKegiatan($tahun_menerima, $filter_tanggal);
        }

        return redirect()->route('admin.laporan.index')->with('error', 'Tipe laporan tidak ditemukan.');
    }

    // Fungsi untuk download Beasiswa
    protected function downloadBeasiswa($year, $filter_date)
    {
        $query = Beasiswa::query();

        // Filter berdasarkan tahun
        if ($year) {
            $query->whereYear('tanggal_menerima', $year);
        }

        // Filter urutan tanggal
        if ($filter_date == 'latest') {
            $query->orderBy('tanggal_menerima', 'desc');
        } elseif ($filter_date == 'oldest') {
            $query->orderBy('tanggal_menerima', 'asc');
        }

        return Excel::download(new BeasiswaExport($year, $filter_date), 'laporan_beasiswa.xlsx');
    }

    // Fungsi untuk download Prestasi
    protected function downloadPrestasi($year, $filter_date)
    {
        $query = Prestasi::query();

        // Filter berdasarkan tahun
        if ($year) {
            $query->whereYear('tanggal_perlombaan', $year);
        }

        // Filter urutan tanggal
        if ($filter_date == 'latest') {
            $query->orderBy('tanggal_perlombaan', 'desc');
        } elseif ($filter_date == 'oldest') {
            $query->orderBy('tanggal_perlombaan', 'asc');
        }

        return Excel::download(new PrestasiExport($year, $filter_date), 'laporan_prestasi.xlsx');
    }

    // Fungsi untuk download Kegiatan
    protected function downloadKegiatan($year, $filter_date)
    {
        $query = Kegiatan::query();

        // Filter berdasarkan tahun
        if ($year) {
            $query->whereYear('tanggal_mulai', $year);
        }

        // Filter urutan tanggal
        if ($filter_date == 'latest') {
            $query->orderBy('tanggal_mulai', 'desc');
        } elseif ($filter_date == 'oldest') {
            $query->orderBy('tanggal_mulai', 'asc');
        }

        return Excel::download(new KegiatanExport($year, $filter_date), 'laporan_kegiatan.xlsx');
    }
}
