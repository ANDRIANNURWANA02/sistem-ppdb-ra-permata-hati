@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Detail Data Pendaftaran</h1>
            <p class="text-sm text-white">
                ID Pendaftaran: {{ $pendaftaran->id }} |
                Dibuat: {{ $pendaftaran->created_at->format('d M Y') }}
            </p>
        </div>

        <span class="px-4 py-2 rounded-full text-sm font-semibold text-white
            {{ $pendaftaran->status_verifikasi == 'lolos' ? 'bg-green-600' :
               ($pendaftaran->status_verifikasi == 'perlu_perbaikan' ? 'bg-yellow-500' : 'bg-gray-500') }}">
            {{ ucfirst(str_replace('_',' ', $pendaftaran->status_verifikasi)) }}
        </span>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- DATA SISWA -->
        <div class="bg-white shadow rounded-lg p-5 col-span-2">
            <h2 class="text-lg font-semibold border-b pb-2 mb-4">🧍 Data Siswa</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Nama Lengkap</span><br><b>{{ $pendaftaran->nama_lengkap }}</b></div>
                <div><span class="text-gray-500">Nama Panggilan</span><br>{{ $pendaftaran->nama_panggilan }}</div>
                <div><span class="text-gray-500">Jenis Kelamin</span><br>{{ $pendaftaran->jenis_kelamin }}</div>
                <div><span class="text-gray-500">Tempat Lahir</span><br>{{ $pendaftaran->tempat_lahir }}</div>
                <div><span class="text-gray-500">Tanggal Lahir</span><br>{{ $pendaftaran->tanggal_lahir }}</div>
                <div><span class="text-gray-500">Agama</span><br>{{ $pendaftaran->agama }}</div>
                <div><span class="text-gray-500">Kewarganegaraan</span><br>{{ $pendaftaran->kewarganegaraan }}</div>
                <div><span class="text-gray-500">Anak Ke</span><br>{{ $pendaftaran->anak_ke }}</div>
                <div><span class="text-gray-500">Jumlah Saudara Kandung</span><br>{{ $pendaftaran->jumlah_saudara_kandung }}</div>
                <div><span class="text-gray-500">Jumlah Saudara Tiri</span><br>{{ $pendaftaran->jumlah_saudara_tiri }}</div>
                <div><span class="text-gray-500">Jumlah Saudara Angkat</span><br>{{ $pendaftaran->jumlah_saudara_angkat }}</div>
                <div><span class="text-gray-500">Bahasa Sehari Hari</span><br>{{ $pendaftaran->bahasa_sehari_hari }}</div>
                <div><span class="text-gray-500">Tinggi Badan</span><br>{{ $pendaftaran->tinggi_badan }}</div>
                <div><span class="text-gray-500">Berat Badan</span><br>{{ $pendaftaran->berat_badan }}</div>
                <div><span class="text-gray-500">Golongan Darah</span><br>{{ $pendaftaran->golongan_darah }}</div>
                <div><span class="text-gray-500">Riwayat Penyakit</span><br>{{ $pendaftaran->riwayat_penyakit }}</div>
                <div><span class="text-gray-500">Imunisasi</span><br>{{ $pendaftaran->imunisasi }}</div>
                <div><span class="text-gray-500">Ciri Khusus</span><br>{{ $pendaftaran->ciri_khusus }}</div>
                <div><span class="text-gray-500">Makanan Kesukaan</span><br>{{ $pendaftaran->makanan_kesukaan }}</div>
                <div><span class="text-gray-500">Minuman Kesukaan</span><br>{{ $pendaftaran->minuman_kesukaan }}</div>
                <div><span class="text-gray-500">Buah Kesukaan</span><br>{{ $pendaftaran->buah_kesukaan }}</div>
                <div><span class="text-gray-500">Prestasi</span><br>{{ $pendaftaran->prestasi }}</div>
                <div class="md:col-span-2">
                    <span class="text-gray-500">Alamat Lengkap</span><br>
                    {{ $pendaftaran->alamat_lengkap }}
                </div>
            </div>
        </div>

        <!-- STATUS & CATATAN -->
        <div class="bg-white shadow rounded-lg p-5">
            <h2 class="text-lg font-semibold border-b pb-2 mb-4">✅ Verifikasi</h2>

            <p class="text-sm mb-2">
                <b>Status:</b>
                <span class="ml-2 px-3 py-1 rounded-full text-white text-xs
                    {{ $pendaftaran->status_verifikasi == 'lolos' ? 'bg-green-600' :
                       ($pendaftaran->status_verifikasi == 'perlu_perbaikan' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                    {{ ucfirst(str_replace('_',' ', $pendaftaran->status_verifikasi)) }}
                </span>
                <form action="{{ route('admin.verifikasi', $pendaftaran->id) }}" method="POST">
                                    @csrf
                                    <select name="status_verifikasi" class="border rounded px-2 py-1 text-sm mb-1 w-full">
                                        <option value="menunggu" {{ $pendaftaran->status_verifikasi == 'menunggu' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="lolos" {{ $pendaftaran->status_verifikasi == 'lolos' ? 'selected' : '' }}>Lolos
                                        </option>
                                        <option value="perlu_perbaikan" {{ $pendaftaran->status_verifikasi == 'perlu_perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                    </select>

                                    <textarea name="catatan_admin" placeholder="Catatan (opsional)"
                                        class="border rounded px-2 py-1 text-sm w-full mb-1">{{ $pendaftaran->catatan_verifikasi }}</textarea>

                                    <button class="bg-indigo-600 text-white w-full py-1 rounded text-sm">
                                        Simpan
                                    </button>
                            </form>
            </p>

            <div class="text-sm mt-4">
                <b>Catatan Admin:</b>
                <div class="mt-2 bg-gray-100 p-3 rounded">
                    {{ $pendaftaran->catatan_admin ?? 'Tidak ada catatan' }}
                </div>
            </div>
        </div>

        <!-- DATA ORANG TUA -->
<div class="bg-white shadow rounded-lg p-5 col-span-2">
    <h2 class="text-lg font-semibold border-b pb-2 mb-4">
        👨‍👩‍👦 Data Orang Tua
    </h2>

    <!-- DATA AYAH -->
    <div class="mb-4">
        <h3 class="font-semibold text-gray-700 mb-2">👨 Data Ayah</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Nama Ayah</span><br><b>{{ $pendaftaran->nama_ayah }}</b></div>
                <div><span class="text-gray-500">Tempat Lahir</span><br><b>{{ $pendaftaran->tempat_lahir_ayah }}</b></div>
                <div><span class="text-gray-500">Tanggal Lahir</span><br><b>{{ $pendaftaran->tanggal_lahir_ayah }}</b></div>
                <div><span class="text-gray-500">Agama</span><br><b>{{ $pendaftaran->agama_ayah }}</b></div>
                <div><span class="text-gray-500">Kewarganegaraan</span><br><b>{{ $pendaftaran->kewarganegaraan_ayah }}</b></div>
                <div><span class="text-gray-500">Pendidikan Terakhir</span><br><b>{{ $pendaftaran->pendidikan_terakhir_ayah }}</b></div>
                <div><span class="text-gray-500">Pekerjaan</span><br>{{ $pendaftaran->pekerjaan_ayah }}</div>
                <div><span class="text-gray-500">Pangkat</span><br>{{ $pendaftaran->pangkat_ayah }}</div>
                <div><span class="text-gray-500">Golongan Darah</span><br>{{ $pendaftaran->golongan_darah_ayah }}</div>
                <div><span class="text-gray-500">Penghasilan</span><br>{{ $pendaftaran->penghasilan_ayah }}</div>
        </div>
    </div>

    <!-- GARIS PEMISAH -->
    <div class="border-t border-gray-300 my-4"></div>

    <!-- DATA IBU -->
    <div>
        <h3 class="font-semibold text-gray-700 mb-2">👩 Data Ibu</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Nama Ibu</span><br><b>{{ $pendaftaran->nama_ibu }}</b></div>
            <div><span class="text-gray-500">Tempat Lahir</span><br><b>{{ $pendaftaran->tempat_lahir_ibu }}</b></div>
            <div><span class="text-gray-500">Tanggal Lahir</span><br><b>{{ $pendaftaran->tanggal_lahir_ibu }}</b></div>
            <div><span class="text-gray-500">Agama</span><br><b>{{ $pendaftaran->agama_ibu }}</b></div>
            <div><span class="text-gray-500">Kewarganegaraan</span><br><b>{{ $pendaftaran->kewarganegaraan_ibu }}</b></div>
            <div><span class="text-gray-500">Pendidikan Terakhir</span><br>{{ $pendaftaran->pendidikan_terakhir_ibu }}</div>
            <div><span class="text-gray-500">Pekerjaan</span><br>{{ $pendaftaran->pekerjaan_ibu }}</div>
            <div><span class="text-gray-500">Penghasilan</span><br>{{ $pendaftaran->penghasilan_ibu }}</div>
        </div>
    </div>
</div>


        <!-- BERKAS -->
        <div class="bg-white shadow rounded-lg p-5">
            <h2 class="text-lg font-semibold border-b pb-2 mb-4">📎 Berkas</h2>

            <ul class="space-y-2 text-sm">
                <li>
                    Kartu Keluarga
                    @if($pendaftaran->file_kk)
                        <a href="{{ asset('storage/'.$pendaftaran->file_kk) }}" target="_blank"
                           class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">Lihat</a>
                    @else
                        <span class="text-gray-400">Tidak ada</span>
                    @endif
                </li>

                <li>
                    Akta Kelahiran
                    @if($pendaftaran->file_akte)
                        <a href="{{ asset('storage/'.$pendaftaran->file_akte) }}" target="_blank"
                           class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">Lihat</a>
                    @else
                        <span class="text-gray-400">Tidak ada</span>
                    @endif
                </li>

                <li>
                    File Lainnya
                    @if($pendaftaran->file_surat_lain)
                        <a href="{{ asset('storage/'.$pendaftaran->file_surat_lain) }}" target="_blank"
                           class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">Lihat</a>
                    @else
                        <span class="text-gray-400">Tidak ada</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <!-- ACTION -->
    <div class="flex justify-between mt-8">
        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
           ⬅ Kembali
        </a>

        <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}"
           class="bg-green-600 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
           ✏ Edit Data
        </a>
    </div>

</div>
@endsection
