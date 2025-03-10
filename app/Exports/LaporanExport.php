<?php

namespace App\Exports;

use App\Models\Prestasi;
use App\Models\Beasiswa;
use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Exports\BeasiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class BeasiswaExport implements FromCollection, WithHeadings
{
    protected $year;
    protected $filter_date;

    public function __construct($year, $filter_date)
    {
        $this->year = $year;
        $this->filter_date = $filter_date;
    }

    public function collection()
    {
        // Membuat query untuk mendapatkan data beasiswa berdasarkan filter
        $query = Beasiswa::query();

        // Filter berdasarkan tahun
        if ($this->year) {
            $query->whereYear('tanggal_menerima', $this->year)
                  ->orWhereYear('created_at', $this->year);
        }

        // Urutkan berdasarkan tanggal sesuai pilihan filter
        if ($this->filter_date == 'latest') {
            $query->orderBy('tanggal_menerima', 'desc');
        } elseif ($this->filter_date == 'oldest') {
            $query->orderBy('tanggal_menerima', 'asc');
        }

        // Ambil data
        return $query->get([
            'npm', 'nama_penerima', 'prodi', 'nama_beasiswa', 'keterangan', 'tanggal_menerima', 'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'NPM', 'Nama Penerima', 'Program Studi', 'Nama Beasiswa', 'Keterangan', 'Tanggal Menerima', 'Tanggal Melapor'
        ];
    }
    
}