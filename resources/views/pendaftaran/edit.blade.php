@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-6 text-center md:text-center">
            ✏️ Edit Data Pendaftaran
        </h1>

        <!-- Tombol Chatbot -->
        <button id="chatbotButton"
            class="fixed bottom-40 right-8 bg-orange-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-orange-600 transition">
            💬 Bantuan
        </button>

        <!-- Popup Chatbot -->
        <div id="chatbotPopup" class="hidden fixed bottom-20 right-6 w-80 bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-orange-500 text-white px-4 py-2 font-semibold flex justify-between items-center">
                <span>Chatbot Pendaftaran RA</span>
                <button id="closeChat" class="text-white font-bold">&times;</button>
            </div>
            <div id="chatMessages" class="p-3 h-64 overflow-y-auto text-sm"></div>
            <form id="chatForm" class="flex border-t">
                <input id="userMessage" type="text" class="flex-grow p-2 text-sm outline-none" placeholder="Ketik pesan...">
                <button type="submit" class="bg-orange-500 text-white px-4 hover:bg-orange-600">Kirim</button>
            </form>
        </div>
    </div>

    <script>
        const chatbotButton = document.getElementById('chatbotButton');
        const chatbotPopup = document.getElementById('chatbotPopup');
        const closeChat = document.getElementById('closeChat');
        const chatForm = document.getElementById('chatForm');
        const chatMessages = document.getElementById('chatMessages');

        chatbotButton.addEventListener('click', () => chatbotPopup.classList.toggle('hidden'));
        closeChat.addEventListener('click', () => chatbotPopup.classList.add('hidden'));

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = document.getElementById('userMessage').value;
            if (!message.trim()) return;

            // tampilkan pesan user
            chatMessages.innerHTML += `<div class="text-right mb-2"><span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-lg inline-block">${message}</span></div>`;
            document.getElementById('userMessage').value = '';

            // kirim ke n8n
            const response = await fetch('https://n8n-ftnqmvzgt6pp.timah.sumopod.my.id/webhook/9ca0aac1-2cc5-4f7e-a2ec-a4e346efda26/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message })
            });

            const data = await response.json();

            // tampilkan balasan chatbot
            chatMessages.innerHTML += `<div class="text-left mb-2"><span class="bg-gray-100 px-3 py-1 rounded-lg inline-block">${data.reply}</span></div>`;
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    </script>

    <div class="bg-white p-6 rounded-xl shadow-lg max-w-3xl mx-auto">
        <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Identitas Siswa --}}

            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                    value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            <div class="mb-4">
                <label for="nama_panggilan" class="block text-gray-700 font-semibold mb-2">Nama Panggilan</label>
                <input type="text" id="nama_panggilan" name="nama_panggilan"
                    value="{{ old('nama_panggilan', $pendaftaran->nama_panggilan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400"
                    required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <!-- Tempat dan Tanggal Lahir -->
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="tempat_lahir" class="block text-gray-700 font-semibold mb-2">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir"
                        value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>

            <!-- Agama -->
            <div class="mb-4 mt-4">
                <label for="agama" class="block text-gray-700 font-semibold mb-2">Agama</label>
                <input type="text" id="agama" name="agama" value="{{ old('agama', $pendaftaran->agama) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>

            {{-- Kewarganegaraan --}}
            <div class="mb-4 mt-4">
                <label for="kewarganegaraan" class="block text-gray-700 font-semibold mb-2">Kewarganegaraan</label>
                <input type="text" id="kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan', $pendaftaran->kewarganegaraan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Anak ke --}}
            <div class="mb-4 mt-4">
                <label for="anak_ke" class="block text-gray-700 font-semibold mb-2">Anak Ke-</label>
                <input type="text" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $pendaftaran->anak_ke) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- jumlah saidara kandung --}}
            <div class="mb-4 mt-4">
                <label for="jumlah_saudara_kandung" class="block text-gray-700 font-semibold mb-2">Jumlah Saudara Kandung</label>
                <input type="text" id="jumlah_saudara_kandung" name="jumlah_saudara_kandung" value="{{ old('jumlah_saudara_kandung', $pendaftaran->jumlah_saudara_kandung) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- jumlah saudara tiri --}}
            <div class="mb-4 mt-4">
                <label for="jumlah_saudara_tiri" class="block text-gray-700 font-semibold mb-2">Jumlah Saudara Tiri</label>
                <input type="text" id="jumlah_saudara_tiri" name="jumlah_saudara_tiri" value="{{ old('jumlah_saudara_tiri', $pendaftaran->jumlah_saudara_tiri) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- jumlah saudara angkat --}}
            <div class="mb-4 mt-4">
                <label for="jumlah_saudara_angkat" class="block text-gray-700 font-semibold mb-2">Jumlah Saudara Angkat</label>
                <input type="text" id="jumlah_saudara_angkat" name="jumlah_saudara_angkat" value="{{ old('jumlah_saudara_angkat', $pendaftaran->jumlah_saudara_angkat) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Bahasa sehari hari --}}
            <div class="mb-4 mt-4">
                <label for="bahasa_sehari_hari" class="block text-gray-700 font-semibold mb-2">Bahasa Sehari-hari</label>
                <input type="text" id="bahasa_sehari_hari" name="bahasa_sehari_hari" value="{{ old('bahasa_sehari_hari', $pendaftaran->bahasa_sehari_hari) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Tinggi Badan --}}
            <div class="mb-4 mt-4">
                <label for="tinggi_badan" class="block text-gray-700 font-semibold mb-2">Tinggi Badan</label>
                <input type="text" id="tinggi_badan" name="tinggi_badan" value="{{ old('tinggi_badan', $pendaftaran->tinggi_badan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Berat Badan --}}
            <div class="mb-4 mt-4">
                <label for="berat_badan" class="block text-gray-700 font-semibold mb-2">Berat Badan</label>
                <input type="text" id="berat_badan" name="berat_badan" value="{{ old('berat_badan', $pendaftaran->berat_badan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Golongan Darah --}}
            <div class="mb-4 mt-4">
                <label for="golongan_darah" class="block text-gray-700 font-semibold mb-2">Golongan Darah</label>
                <input type="text" id="golongan_darah" name="golongan_darah" value="{{ old('golongan_darah', $pendaftaran->golongan_darah) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Riwayat Penyakit --}}
            <div class="mb-4 mt-4">
                <label for="riwayat_penyakit" class="block text-gray-700 font-semibold mb-2">Riwayat Penyakit</label>
                <input type="text" id="riwayat_penyakit" name="riwayat_penyakit" value="{{ old('riwayat_penyakit', $pendaftaran->riwayat_penyakit) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Imunisasi --}}
            <div class="mb-4 mt-4">
                <label for="imunisasi" class="block text-gray-700 font-semibold mb-2">Imunisasi</label>
                <input type="text" id="imunisasi" name="imunisasi" value="{{ old('imunisasi', $pendaftaran->imunisasi) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Ciri Khusus --}}
            <div class="mb-4 mt-4">
                <label for="ciri_khusus" class="block text-gray-700 font-semibold mb-2">Ciri Khusus</label>
                <input type="text" id="ciri_khusus" name="ciri_khusus" value="{{ old('ciri_khusus', $pendaftaran->ciri_khusus) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Makanan Kesukaan --}}
            <div class="mb-4 mt-4">
                <label for="makanan_kesukaan" class="block text-gray-700 font-semibold mb-2">Makanan Kesukaan</label>
                <input type="text" id="makanan_kesukaan" name="makanan_kesukaan" value="{{ old('makanan_kesukaan', $pendaftaran->makanan_kesukaan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Minuman Kesukaan --}}
            <div class="mb-4 mt-4">
                <label for="minuman_kesukaan" class="block text-gray-700 font-semibold mb-2">Minuman Kesukaan</label>
                <input type="text" id="minuman_kesukaan" name="minuman_kesukaan" value="{{ old('minuman_kesukaan', $pendaftaran->minuman_kesukaan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Buah Kesukaan --}}
            <div class="mb-4 mt-4">
                <label for="buah_kesukaan" class="block text-gray-700 font-semibold mb-2">Buah Kesukaan</label>
                <input type="text" id="buah_kesukaan" name="buah_kesukaan" value="{{ old('buah_kesukaan', $pendaftaran->buah_kesukaan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>
            
            {{-- Prestasi --}}
            <div class="mb-4 mt-4">
                <label for="prestasi" class="block text-gray-700 font-semibold mb-2">Hobi atau Prestasi</label>
                <input type="text" id="prestasi" name="prestasi" value="{{ old('prestasi', $pendaftaran->prestasi) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat_lengkap" class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400"
                    required>{{ old('alamat_lengkap', $pendaftaran->alamat_lengkap) }}</textarea>
            </div>

            <!-- Nama Ayah dan Ibu -->
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="nama_ayah" class="block text-gray-700 font-semibold mb-2">Nama Ayah</label>
                    <input type="text" id="nama_ayah" name="nama_ayah"
                        value="{{ old('nama_ayah', $pendaftaran->nama_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="nama_ibu" class="block text-gray-700 font-semibold mb-2">Nama Ibu</label>
                    <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $pendaftaran->nama_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Tempat Lahir --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="tempat_lahir_ayah" class="block text-gray-700 font-semibold mb-2">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                        value="{{ old('tempat_lahir_ayah', $pendaftaran->tempat_lahir_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="tempat_lahir_ibu" class="block text-gray-700 font-semibold mb-2">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir_ibu" name="tempat_lahir_ibu" value="{{ old('tempat_lahir_ibu', $pendaftaran->tempat_lahir_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Agama --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="agama_ayah" class="block text-gray-700 font-semibold mb-2">Agama</label>
                    <input type="text" id="agama_ayah" name="agama_ayah"
                        value="{{ old('agama_ayah', $pendaftaran->agama_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="agama_ibu" class="block text-gray-700 font-semibold mb-2">Agama</label>
                    <input type="text" id="agama_ibu" name="agama_ibu" value="{{ old('agama_ibu', $pendaftaran->agama_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Agama --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="kewarganegaraan_ayah" class="block text-gray-700 font-semibold mb-2">Kewarganegaraan</label>
                    <input type="text" id="kewarganegaraan_ayah" name="kewarganegaraan_ayah"
                        value="{{ old('kewarganegaraan_ayah', $pendaftaran->kewarganegaraan_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="kewarganegaraan_iu" class="block text-gray-700 font-semibold mb-2">Kewarganegaraan</label>
                    <input type="text" id="kewarganegaraan_iu" name="kewarganegaraan_iu" value="{{ old('kewarganegaraan_iu', $pendaftaran->agama_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Kewarganegaraan --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="kewarganegaraan_ayah" class="block text-gray-700 font-semibold mb-2">Kewarganegaraan</label>
                    <input type="text" id="kewarganegaraan_ayah" name="kewarganegaraan_ayah"
                        value="{{ old('kewarganegaraan_ayah', $pendaftaran->kewarganegaraan_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="kewarganegaraan_ibu" class="block text-gray-700 font-semibold mb-2">Kewarganegaraan</label>
                    <input type="text" id="kewarganegaraan_ibu" name="kewarganegaraan_ibu" value="{{ old('kewarganegaraan_ibu', $pendaftaran->kewarganegaraan_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Pendidikan Terkahir --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="pendidikan_terakhir_ayah" class="block text-gray-700 font-semibold mb-2">Pendidikan Terakhir</label>
                    <input type="text" id="pendidikan_terakhir_ayah" name="pendidikan_terakhir_ayah"
                        value="{{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="pendidikan_terakhir_ibu" class="block text-gray-700 font-semibold mb-2">Pendidikan Terakhir</label>
                    <input type="text" id="pendidikan_terakhir_ibu" name="pendidikan_terakhir_ibu" value="{{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Golongan Darah --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="golongan_darah_ayah" class="block text-gray-700 font-semibold mb-2">Golongan Darah</label>
                    <input type="text" id="golongan_darah_ayah" name="golongan_darah_ayah"
                        value="{{ old('golongan_darah_ayah', $pendaftaran->golongan_darah_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="golongan_darah_ibu" class="block text-gray-700 font-semibold mb-2">Golongan Darah</label>
                    <input type="text" id="golongan_darah_ibu" name="golongan_darah_ibu" value="{{ old('golongan_darah_ibu', $pendaftaran->golongan_darah_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Pekerjaan --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="pekerjaan_ayah" class="block text-gray-700 font-semibold mb-2">Pekerjaan</label>
                    <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah"
                        value="{{ old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="pekerjaan_ibu" class="block text-gray-700 font-semibold mb-2">Pekerjaan</label>
                    <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Pangkat --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="pangkat_ayah" class="block text-gray-700 font-semibold mb-2">Pangkat</label>
                    <input type="text" id="pangkat_ayah" name="pangkat_ayah"
                        value="{{ old('pangkat_ayah', $pendaftaran->pangkat_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="pangkat_ibu" class="block text-gray-700 font-semibold mb-2">Pangkat</label>
                    <input type="text" id="pangkat_ibu" name="pangkat_ibu" value="{{ old('pangkat_ibu', $pendaftaran->pangkat_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>
            
            {{-- Penghasilan --}}
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="penghasilan_ayah" class="block text-gray-700 font-semibold mb-2">Penghasilan</label>
                    <input type="text" id="penghasilan_ayah" name="penghasilan_ayah"
                        value="{{ old('penghasilan_ayah', $pendaftaran->penghasilan_ayah) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
                <div>
                    <label for="penghasilan_ibu" class="block text-gray-700 font-semibold mb-2">Penghasilan</label>
                    <input type="text" id="penghasilan_ibu" name="penghasilan_ibu" value="{{ old('penghasilan_ibu', $pendaftaran->penghasilan_ibu) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-yellow-400" required>
                </div>
            </div>

            <!-- File Upload -->
            <div class="grid md:grid-cols-3 gap-4 mt-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">File KK</label>
                    @if($pendaftaran->file_kk)
                        <a href="{{ asset('storage/' . $pendaftaran->file_kk) }}" target="_blank"
                            class="text-blue-600 hover:underline text-sm">Lihat KK</a>
                    @endif
                    <input type="file" name="file_kk" class="w-full border-gray-300 rounded-lg p-2 mt-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">File Akte</label>
                    @if($pendaftaran->file_akte)
                        <a href="{{ asset('storage/' . $pendaftaran->file_akte) }}" target="_blank"
                            class="text-blue-600 hover:underline text-sm">Lihat Akte</a>
                    @endif
                    <input type="file" name="file_akte" class="w-full border-gray-300 rounded-lg p-2 mt-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">File Lainnya</label>
                    @if($pendaftaran->file_surat_lain)
                        <a href="{{ asset('storage/' . $pendaftaran->file_surat_lain) }}" target="_blank"
                            class="text-blue-600 hover:underline text-sm">Lihat File</a>
                    @endif
                    <input type="file" name="file_surat_lain" class="w-full border-gray-300 rounded-lg p-2 mt-2">
                </div>
            </div>
            <!-- Tombol -->
            <div class="flex justify-between mt-8">
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">⬅ Kembali</a>
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
    </div>
@endsection