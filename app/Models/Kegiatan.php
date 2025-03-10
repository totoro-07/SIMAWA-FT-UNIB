<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';
    
    protected $fillable = [
        'nama_kegiatan', 'jenis_kegiatan', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'penyelenggara', 'deskripsi', 'gambar', 'status'
    ];
}

