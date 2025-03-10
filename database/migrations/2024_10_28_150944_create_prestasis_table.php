<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 15); // Menambahkan NPM sebagai VARCHAR(15)
            $table->string('nama_mahasiswa', 150); // Nama Mahasiswa
            $table->string('program_studi', 100); // Program Studi
            $table->string('nama_perlombaan', 150); // Nama Perlombaan
            $table->string('juara', 50); // Juara
            $table->string('tingkat_perlombaan', 100); // Tingkat Perlombaan
            $table->date('tanggal_pelaporan'); // Tanggal Pelaporan
            $table->string('sertifikat')->nullable(); // Sertifikat (file path)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestasis');
    }
};
