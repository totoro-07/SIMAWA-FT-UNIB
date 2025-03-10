<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 15);
            $table->string('nama_penerima', 150);
            $table->string('prodi', 100);
            $table->string('semester', 10);
            $table->string('nama_beasiswa', 150);
            $table->date('tanggal_menerima')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('bukti_beasiswa')->nullable();
            $table->enum('status_verifikasi', ['belum_verifikasi', 'terverifikasi'])->default('belum_verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beasiswas');
    }
};
