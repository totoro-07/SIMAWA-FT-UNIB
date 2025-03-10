<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    // Nama tabel di database
    protected $table = 'beasiswas';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'npm',
        'nama_penerima',
        'prodi',
        'semester',
        'nama_beasiswa',
        'keterangan',
        'tanggal_menerima',
        'status_verifikasi',
        'bukti_beasiswa', // Menambahkan kolom bukti_beasiswa
    ];

    // Primary key
    protected $primaryKey = 'id'; // Menggunakan id sebagai primary key

    // Tipe data primary key (menggunakan auto-increment)
    public $incrementing = true; // Default auto-increment
    protected $keyType = 'int'; // Menggunakan tipe data integer untuk id

    // Jika Anda memiliki kolom timestamp 'created_at' dan 'updated_at'
    public $timestamps = true;

    // Jika ingin melakukan cast data untuk bukti_beasiswa ke string atau path
    protected $casts = [
        'bukti_beasiswa' => 'string', // Menyimpan path bukti beasiswa
    ];

    // Menggunakan accessor untuk mendapatkan URL bukti beasiswa jika perlu
    public function getBuktiBeasiswaUrlAttribute()
    {
        return asset('storage/' . $this->bukti_beasiswa); // Menampilkan URL untuk bukti beasiswa
    }
}

