<?php

namespace App\Exports;

use App\Models\Beasiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BeasiswaExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
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
        $query = Beasiswa::query();

        // Filter berdasarkan tahun untuk tanggal menerima
        if ($this->year) {
            $query->whereYear('tanggal_menerima', $this->year);
        }

        // Filter urutan berdasarkan tanggal
        if ($this->filter_date == 'latest') {
            $query->orderBy('tanggal_menerima', 'desc');
        } elseif ($this->filter_date == 'oldest') {
            $query->orderBy('tanggal_menerima', 'asc');
        }

        // Ambil data yang dibutuhkan dan sesuaikan dengan field yang ada
        return Beasiswa::select([
            'npm',
            'nama_penerima',
            'prodi',
            'nama_beasiswa',
            'tanggal_menerima',
            DB::raw('IF(updated_at > created_at, updated_at, created_at) as tanggal_melapor')
        ])
        ->get()
        ->map(function ($item) {
            // Pastikan tanggal melapor berupa tanggal valid
            $item->tanggal_melapor = \Carbon\Carbon::parse($item->tanggal_melapor)->format('Y-m-d');
            return $item;
        });
        
    }

    public function headings(): array
    {
        return [
            'NPM',
            'Nama Mahasiswa',
            'Program Studi',
            'Nama Beasiswa',
            'Tanggal Menerima',
            'Tanggal Melapor', // Judul kolom untuk created_at yang digunakan sebagai tanggal melapor
        ];
    }

    // Menambahkan styling pada header dan data
    public function styles($sheet)
    {
        // Menambahkan bold pada header
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center'); // Perataan tengah untuk header

        // Perataan tengah untuk seluruh data
        $sheet->getStyle('A2:F' . $sheet->getHighestRow())->getAlignment()->setHorizontal('center');

        // Menambahkan border tipis pada seluruh data
        $sheet->getStyle('A2:F' . $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Format Tanggal Menerima dan Tanggal Melapor
        $sheet->getStyle('E2:F' . $sheet->getHighestRow())
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY); // Format tanggal dd/mm/yyyy
    }

    // Mengatur lebar kolom agar lebih rapi
    public function columnWidths(): array
    {
        return [
            'A' => 15, // Lebar kolom NPM
            'B' => 30, // Lebar kolom Nama Mahasiswa
            'C' => 25, // Lebar kolom Program Studi
            'D' => 35, // Lebar kolom Nama Beasiswa
            'E' => 20, // Lebar kolom Tanggal Menerima
            'F' => 20, // Lebar kolom Tanggal Melapor
        ];
    }
}

