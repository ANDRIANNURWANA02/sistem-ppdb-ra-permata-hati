<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
    $table->id();

    // Data Anak
    $table->string('nama_lengkap');
    $table->string('nama_panggilan')->nullable();
    $table->string('jenis_kelamin');
    $table->string('tempat_lahir')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('agama')->nullable();
    $table->string('kewarganegaraan')->nullable();
    $table->string('anak_ke')->nullable();
    $table->string('jumlah_saudara_kandung')->nullable();
    $table->string('jumlah_saudara_tiri')->nullable();
    $table->string('jumlah_saudara_angkat')->nullable();
    $table->string('bahasa_sehari_hari')->nullable();
    $table->string('tinggi_badan')->nullable();
    $table->string('berat_badan')->nullable();
    $table->string('golongan_darah')->nullable();
    $table->string('riwayat_penyakit')->nullable();
    $table->string('imunisasi')->nullable();
    $table->string('ciri_khusus')->nullable();
    $table->string('makanan_kesukaan')->nullable();
    $table->string('minuman_kesukaan')->nullable();
    $table->string('buah_kesukaan')->nullable();
    $table->string('prestasi')->nullable();
    $table->text('alamat_lengkap')->nullable();

    // Data Ayah
    $table->string('nama_ayah')->nullable();
    $table->string('tempat_lahir_ayah')->nullable();
    $table->date('tanggal_lahir_ayah')->nullable();
    $table->string('agama_ayah')->nullable();
    $table->string('kewarganegaraan_ayah')->nullable();
    $table->string('pendidikan_terakhir_ayah')->nullable();
    $table->string('pekerjaan_ayah')->nullable();
    $table->string('pangkat_ayah')->nullable();
    $table->string('golongan_darah_ayah')->nullable();
    $table->string('penghasilan_ayah')->nullable();

    // Data Ibu
    $table->string('nama_ibu')->nullable();
    $table->string('tempat_lahir_ibu')->nullable();
    $table->date('tanggal_lahir_ibu')->nullable();
    $table->string('agama_ibu')->nullable();
    $table->string('kewarganegaraan_ibu')->nullable();
    $table->string('pendidikan_terakhir_ibu')->nullable();
    $table->string('pekerjaan_ibu')->nullable();
    $table->string('penghasilan_ibu')->nullable();
    $table->string('kemampuan')->nullable();

    // File upload
    $table->string('file_kk')->nullable();
    $table->string('file_akte')->nullable();
    $table->string('file_surat_lain')->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
