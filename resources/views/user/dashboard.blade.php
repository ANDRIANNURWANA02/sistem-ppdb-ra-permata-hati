@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-white text-2xl font-bold text-gray-800">
                Dashboard Pendaftaran
            </h1>

            {{-- Tombol Aksi --}}
            @if($pendaftaran)
                @if($pendaftaran->status_verifikasi === 'perlu_perbaikan')
                    <a href="{{ route('user.pendaftaran.edit', $pendaftaran->id) }}"
                        class="bg-green-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow">
                        ✏️ Perbaiki Data
                    </a>

                @elseif($pendaftaran->status_verifikasi === 'lolos')
                    <button class="bg-gray-300 text-gray-600 px-5 py-2 rounded-lg text-sm font-semibold cursor-not-allowed" disabled
                        title="Data sudah diverifikasi dan tidak dapat diubah">
                        ✔ Data Terkunci
                    </button>
                @endif
            @endif
        </div>



        @if(!$pendaftaran)
            <div class="bg-white p-10 rounded-2xl shadow text-center">
        <h2 class="text-2xl font-bold mb-4">
            Anda belum melakukan pendaftaran
        </h2>
        <p class="text-gray-600 mb-6">
            Silakan lakukan pendaftaran untuk melanjutkan proses PPDB.
        </p>

        <a href="{{ route('pendaftaran.index') }}"
           class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600">
            📝 Daftar Sekarang
        </a>
    </div>
        @else

            {{-- ================= STATUS VERIFIKASI ================= --}}
            <div class="mb-6">
                @if($pendaftaran->status_verifikasi === 'menunggu')
                    <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-6 py-4 rounded-xl">
                        ⏳ <b>Status:</b> Menunggu verifikasi admin
                    </div>

                @elseif($pendaftaran->status_verifikasi === 'lolos')
                    <div class="bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded-xl">
                        ✅ <b>Status:</b> LOLOS
                    </div>

                @elseif($pendaftaran->status_verifikasi === 'perlu_perbaikan')
                    <div class="bg-red-100 border border-red-300 text-red-800 px-6 py-4 rounded-xl">
                        ⚠️ <b>Status:</b> Perlu Perbaikan
                        @if($pendaftaran->catatan_admin)
                            <div class="mt-3 bg-white border rounded-lg p-4 text-sm">
                                <b>Catatan Admin:</b><br>
                                {{ $pendaftaran->catatan_admin }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            {{-- ================= DATA ANAK ================= --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">👶 Data Anak</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div><span class="text-gray-500">Nama Lengkap</span><br><b>{{ $pendaftaran->nama_lengkap }}</b></div>
                    <div><span class="text-gray-500">Nama Panggilan</span><br>{{ $pendaftaran->nama_panggilan }}</div>
                    <div><span class="text-gray-500">Jenis Kelamin</span><br>{{ $pendaftaran->jenis_kelamin }}</div>
                    <div><span class="text-gray-500">Tempat Lahir</span><br>{{ $pendaftaran->tempat_lahir }}</div>
                    <div><span class="text-gray-500">Tanggal Lahir</span><br>{{ $pendaftaran->tanggal_lahir }}</div>
                    <div><span class="text-gray-500">Agama</span><br>{{ $pendaftaran->agama }}</div>
                    <div><span class="text-gray-500">Kewarganegaraan</span><br>{{ $pendaftaran->kewarganegaraan }}</div>
                    <div><span class="text-gray-500">Anak Ke</span><br>{{ $pendaftaran->anak_ke }}</div>
                    <div><span class="text-gray-500">Jumlah Saudara Kandung</span><br>{{ $pendaftaran->jumlah_saudara_kandung }}
                    </div>
                    <div><span class="text-gray-500">Jumlah Saudara Tiri</span><br>{{ $pendaftaran->jumlah_saudara_tiri }}</div>
                    <div><span class="text-gray-500">Jumlah Saudara Angkat</span><br>{{ $pendaftaran->jumlah_saudara_angkat }}
                    </div>
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

            {{-- ================= DATA ORANG TUA ================= --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">👨‍👩‍👧 Data Orang Tua</h2>

                {{-- AYAH --}}
                <h3 class="font-semibold mb-2">Data Ayah</h3>
                <div class="mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div><span class="text-gray-500">Nama Ayah</span><br><b>{{ $pendaftaran->nama_ayah }}</b></div>
                        <div><span class="text-gray-500">Tempat Lahir</span><br><b>{{ $pendaftaran->tempat_lahir_ayah }}</b>
                        </div>
                        <div><span class="text-gray-500">Tanggal Lahir</span><br><b>{{ $pendaftaran->tanggal_lahir_ayah }}</b>
                        </div>
                        <div><span class="text-gray-500">Agama</span><br><b>{{ $pendaftaran->agama_ayah }}</b></div>
                        <div><span
                                class="text-gray-500">Kewarganegaraan</span><br><b>{{ $pendaftaran->kewarganegaraan_ayah }}</b>
                        </div>
                        <div><span class="text-gray-500">Pendidikan
                                Terakhir</span><br><b>{{ $pendaftaran->pendidikan_terakhir_ayah }}</b></div>
                        <div><span class="text-gray-500">Pekerjaan</span><br>{{ $pendaftaran->pekerjaan_ayah }}</div>
                        <div><span class="text-gray-500">Pangkat</span><br>{{ $pendaftaran->pangkat_ayah }}</div>
                        <div><span class="text-gray-500">Golongan Darah</span><br>{{ $pendaftaran->golongan_darah_ayah }}</div>
                        <div><span class="text-gray-500">Penghasilan</span><br>{{ $pendaftaran->penghasilan_ayah }}</div>
                    </div>
                </div>

                <hr class="my-6 border-dashed">

                {{-- IBU --}}
                <h3 class="font-semibold mb-2">Data Ibu</h3>
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div><span class="text-gray-500">Nama Ibu</span><br><b>{{ $pendaftaran->nama_ibu }}</b></div>
                        <div><span class="text-gray-500">Tempat Lahir</span><br><b>{{ $pendaftaran->tempat_lahir_ibu }}</b>
                        </div>
                        <div><span class="text-gray-500">Tanggal Lahir</span><br><b>{{ $pendaftaran->tanggal_lahir_ibu }}</b>
                        </div>
                        <div><span class="text-gray-500">Agama</span><br><b>{{ $pendaftaran->agama_ibu }}</b></div>
                        <div><span
                                class="text-gray-500">Kewarganegaraan</span><br><b>{{ $pendaftaran->kewarganegaraan_ibu }}</b>
                        </div>
                        <div><span class="text-gray-500">Pendidikan
                                Terakhir</span><br>{{ $pendaftaran->pendidikan_terakhir_ibu }}</div>
                        <div><span class="text-gray-500">Pekerjaan</span><br>{{ $pendaftaran->pekerjaan_ibu }}</div>
                        <div><span class="text-gray-500">Penghasilan</span><br>{{ $pendaftaran->penghasilan_ibu }}</div>
                    </div>
                </div>
            </div>

            {{-- ================= DOKUMEN ================= --}}
            <div class="bg-white shadow rounded-lg p-5">
                <h2 class="text-lg font-semibold border-b pb-2 mb-4">📎 Berkas</h2>

                <ul class="space-y-2 text-sm">
                    <li>
                        Kartu Keluarga
                        @if($pendaftaran->file_kk)
                            <a href="{{ asset('storage/' . $pendaftaran->file_kk) }}" target="_blank"
                                class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">Lihat</a>
                        @else
                            <span class="text-gray-400">Tidak ada</span>
                        @endif
                    </li>

                    <li>
                        Akta Kelahiran
                        @if($pendaftaran->file_akte)
                            <a href="{{ asset('storage/' . $pendaftaran->file_akte) }}" target="_blank"
                                class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">Lihat</a>
                        @else
                            <span class="text-gray-400">Tidak ada</span>
                        @endif
                    </li>

                    <li>
                        File Lainnya
                        @if($pendaftaran->file_surat_lain)
                            <a href="{{ asset('storage/' . $pendaftaran->file_surat_lain) }}" target="_blank"
                                class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">Lihat</a>
                        @else
                            <span class="text-gray-400">Tidak ada</span>
                        @endif
                    </li>
                </ul>
            </div>
        @endif
    </div>
@endsection