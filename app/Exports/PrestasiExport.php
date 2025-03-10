<?php

namespace App\Exports;

use App\Models\Prestasi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PrestasiExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
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
        $query = Prestasi::query();

        // Filter berdasarkan tahun
        if ($this->year) {
            $query->whereYear('tanggal_pelaporan', $this->year)
                ->orWhereYear('created_at', $this->year);
        }

        // Filter urutan tanggal
        if ($this->filter_date == 'latest') {
            $query->orderBy('tanggal_pelaporan', 'desc');
        } elseif ($this->filter_date == 'oldest') {
            $query->orderBy('tanggal_pelaporan', 'asc');
        }

        // Ambil data yang sudah difilter
        return $query->get([
            'npm', 'nama_mahasiswa', 'program_studi', 'nama_perlombaan', 
            'juara', 'tingkat_perlombaan', 'tanggal_pelaporan',DB::raw('COALESCE(updated_at, created_at) as tanggal_melapor'),
        ]);
    }

    public function headings(): array
    {
        return [
            'NPM', 'Nama Mahasiswa', 'Program Studi', 'Nama Perlombaan', 
            'Juara', 'Tingkat Perlombaan', 'Tanggal Perlombaan','Tanggal Melapor',
        ];
    }

    // Menambahkan styling pada header dan data
    public function styles($sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);  // Bold untuk header
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center');  // Perataan tengah untuk header

        $sheet->getStyle('A2:G' . $sheet->getHighestRow())->getAlignment()->setHorizontal('center');  // Perataan tengah untuk seluruh data
        $sheet->getStyle('A2:G' . $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);  // Menambahkan border tipis pada seluruh data

        // Format Tanggal Pelaporan
        $sheet->getStyle('G2:G' . $sheet->getHighestRow())
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);  // Mengatur format tanggal dd/mm/yyyy
    }

    // Mengatur lebar kolom agar terlihat lebih rapi
    public function columnWidths(): array
    {
        return [
            'A' => 15, // Lebar kolom NPM
            'B' => 30, // Lebar kolom Nama Mahasiswa
            'C' => 25, // Lebar kolom Program Studi
            'D' => 35, // Lebar kolom Nama Perlombaan
            'E' => 15, // Lebar kolom Juara
            'F' => 20, // Lebar kolom Tingkat Perlombaan
            'G' => 20, // Lebar kolom Tanggal Pelaporan
            'H' => 20, // Le
        ];
    }
}


