<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'npm',
        'nama_mahasiswa',
        'program_studi',
        'nama_perlombaan',
        'juara',
        'tingkat_perlombaan',
        'tanggal_pelaporan',
        'sertifikat',
    ];

    // Akses URL Sertifikat
    public function getSertifikatUrlAttribute()
    {
        if ($this->sertifikat) {
            return asset('storage/sertifikat/' . $this->sertifikat);
        }
        return null;
    }
}
