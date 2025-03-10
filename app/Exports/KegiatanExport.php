<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Facades\DB;

class KegiatanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $year;
    protected $filter_date;

    public function __construct($year = null, $filter_date = null)
    {
        $this->year = $year;
        $this->filter_date = $filter_date;
    }

    public function collection()
    {
        $query = Kegiatan::query();

        // Filter berdasarkan tahun untuk tanggal mulai
        if ($this->year) {
            $query->whereYear('tanggal_mulai', $this->year);
        }

        // Filter urutan berdasarkan tanggal
        if ($this->filter_date == 'latest') {
            $query->orderBy('tanggal_mulai', 'desc');
        } elseif ($this->filter_date == 'oldest') {
            $query->orderBy('tanggal_mulai', 'asc');
        }

        // Ambil data yang dibutuhkan, dengan menggunakan raw SQL untuk menggabungkan created_at dan updated_at
        return $query->select([
            'nama_kegiatan', 'jenis_kegiatan', 'lokasi', 'tanggal_mulai',
            'tanggal_selesai', 'penyelenggara', 'deskripsi',
            DB::raw('COALESCE(updated_at, created_at) as tanggal_melapor'), // Menggunakan COALESCE untuk memilih updated_at atau created_at
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Kegiatan', 'Jenis Kegiatan', 'Lokasi', 'Tanggal Mulai',
            'Tanggal Selesai', 'Penyelenggara', 'Deskripsi', 'Tanggal Melapor', // Tambahkan Tanggal Melapor
        ];
    }

// Update styling untuk menyesuaikan dengan kolom tambahan
    public function styles($sheet)
    {
        // Menambahkan bold pada header
        $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Update ke H1 untuk kolom tambahan
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal('center'); // Perataan tengah untuk header

        // Perataan tengah untuk seluruh data
        $sheet->getStyle('A2:H' . $sheet->getHighestRow())->getAlignment()->setHorizontal('center');

        // Menambahkan border tipis pada seluruh data
        $sheet->getStyle('A2:H' . $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Format Tanggal Mulai, Tanggal Selesai, dan Tanggal Melapor
        $sheet->getStyle('D2:E' . $sheet->getHighestRow())
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY); // Format tanggal dd/mm/yyyy

        $sheet->getStyle('H2:H' . $sheet->getHighestRow())
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY); // Format tanggal untuk Tanggal Melapor
    }

    // Mengatur lebar kolom agar lebih rapi
    public function columnWidths(): array
    {
        return [
            'A' => 35, // Lebar kolom Nama Kegiatan
            'B' => 20, // Lebar kolom Jenis Kegiatan
            'C' => 25, // Lebar kolom Lokasi
            'D' => 20, // Lebar kolom Tanggal Mulai
            'E' => 20, // Lebar kolom Tanggal Selesai
            'F' => 25, // Lebar kolom Penyelenggara
            'G' => 40, // Lebar kolom Deskripsi
            'H' => 20, // Lebar kolom Tanggal Melapor
        ];
    }
}
