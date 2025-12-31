<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // tambahkan ini biar bisa diisi otomatis saat user daftar
        'nama_lengkap', 'nama_panggilan', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama',
        'kewarganegaraan', 'anak_ke', 'jumlah_saudara_kandung', 'jumlah_saudara_tiri', 'jumlah_saudara_angkat',
        'bahasa_sehari_hari', 'tinggi_badan', 'berat_badan', 'golongan_darah', 'riwayat_penyakit', 'imunisasi',
        'ciri_khusus', 'makanan_kesukaan', 'minuman_kesukaan', 'buah_kesukaan', 'prestasi', 'alamat_lengkap',
        'nama_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'agama_ayah', 'kewarganegaraan_ayah',
        'pendidikan_terakhir_ayah', 'pekerjaan_ayah', 'pangkat_ayah', 'golongan_darah_ayah', 'penghasilan_ayah',
        'nama_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'agama_ibu', 'kewarganegaraan_ibu',
        'pendidikan_terakhir_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'kemampuan',
        'file_kk', 'file_akte', 'file_surat_lain', 'status_verifikasi', 'catatan_admin',
    ];

    /**
     * Relasi ke model User
     * Setiap pendaftaran dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
