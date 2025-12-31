<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun | RA Permata Hati</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex items-center justify-center p-6">
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
      <input id="userMessage" 
             type="text" 
             class="flex-grow p-2 text-sm outline-none" 
             placeholder="Ketik pesan...">
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
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({ message })
    });

    const data = await response.json();

    // tampilkan balasan chatbot
    chatMessages.innerHTML += `<div class="text-left mb-2"><span class="bg-gray-100 px-3 py-1 rounded-lg inline-block">${data.reply}</span></div>`;
    chatMessages.scrollTop = chatMessages.scrollHeight;
  });
</script>

    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
        <!-- Logo Sekolah -->
        <div class="text-center mb-6">
            <img src="{{ asset('img/logora.png') }}" 
                 alt="Logo RA Permata Hati" 
                 class="h-20 w-20 mx-auto rounded-full border-4 border-yellow-400 shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Pendaftaran Siswa Baru</h1>
            <p class="text-sm text-gray-500">RA Permata Hati</p>
        </div>

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <!-- IDENTITAS CALON SISWA -->
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b-2 border-yellow-500 pb-2">Identitas Calon Siswa</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Nama Panggilan</label>
                        <input type="text" name="nama_panggilan" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Agama</label>
                        <input type="text" name="agama" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Anak Ke-</label>
                        <input type="text" name="anak_ke" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Jumlah saudara kandung</label>
                        <input type="text" name="jumlah_saudara_kandung" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Jumlah saudara tiri</label>
                        <input type="text" name="jumlah_saudara_tiri" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Jumlah saudara angkat</label>
                        <input type="text" name="jumlah_saudara_angkat" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Bahasa sehari - hari</label>
                        <input type="text" name="bahasa_sehari_hari" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Tinggi badan</label>
                        <input type="text" name="tinggi_badan" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Berat badan</label>
                        <input type="text" name="berat_badan" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Golongan darah</label>
                        <input type="text" name="golongan_darah" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Riwayat penyakit</label>
                        <input type="text" name="riwayat_penyakit" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Imunisasi</label>
                        <input type="text" name="imunisasi" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Ciri khusus</label>
                        <input type="text" name="ciri_khusus" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Makanan kesukaan</label>
                        <input type="text" name="makanan_kesukaan" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Minuman kesukaan</label>
                        <input type="text" name="minuman_kesukaan" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Buah kesukaan</label>
                        <input type="text" name="buah_kesukaan" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Prestasi</label>
                        <input type="text" name="prestasi" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-600 mb-1">Alamat Rumah</label>
                        <textarea name="alamat_lengkap" rows="2" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400"></textarea>
                    </div>
                </div>
            </div>

            <!-- IDENTITAS AYAH -->
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b-2 border-yellow-500 pb-2">Identitas Ayah</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">Nama Ayah</label>
                        <input type="text" name="nama_ayah" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_ayah" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir_ayah" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Agama</label>
                        <input type="text" name="agama_ayah" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan_ayah" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Pendidikan Terakhir</label>
                        <select name="pendidikan_terakhir_ayah" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                            <option value="">-- Pilih Pendidikan Terakhir --</option>
                            <option value="s3">S3</option>
                            <option value="s2">S2</option>
                            <option value="s1">S1</option>
                            <option value="sma">SMA - Sederajat</option>
                            <option value="smp">SMP - Sederajat</option>
                            <option value="sd">SD - Sederajat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Pangkat</label>
                        <input type="text" name="pangkat_ayah" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Golongan Darah</label>
                        <input type="text" name="golongan_darah_ayah" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Besar Penghasilan (Rp)</label>
                        <input type="text" name="penghasilan_ayah" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                </div>
            </div>
             <div>

                <!-- IDENTITAS IBU -->
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b-2 border-yellow-500 pb-2">Identitas Ibu</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">Nama Ibu</label>
                        <input type="text" name="nama_ibu" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_ibu" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir_ibu" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Agama</label>
                        <input type="text" name="agama_ibu" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan_ibu" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Pendidikan Terakhir</label>
                        <select name="pendidikan_terakhir_ibu" required class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                            <option value="">-- Pilih Pendidikan Terakhir --</option>
                            <option value="s3">S3</option>
                            <option value="s2">S2</option>
                            <option value="s1">S1</option>
                            <option value="sma">SMA - Sederajat</option>
                            <option value="smp">SMP - Sederajat</option>
                            <option value="sd">SD - Sederajat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Besar Penghasilan (Rp)</label>
                        <input type="text" name="penghasilan_ibu" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Kemampuan</label>
                        <input type="text" name="kemampuan" class="w-full border-gray-300 rounded-lg p-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>
                </div>
            </div>
            <!-- ========== LAMPIRAN ========== --> 
            <section> 
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b-2 border-yellow-500 pb-2">Lampiran Dokumen</h3> <div class="grid grid-cols-1 md:grid-cols-3 gap-5"> 
                <div> 
                    <label class="block text-gray-800 font-medium mb-1">Kartu Keluarga</label> 
                    <input type="file" name="file_kk" class="w-full border-gray-300 rounded-lg p-2.5 bg-gray-50"> 
                </div> <div> <label class="block text-gray-800 font-medium mb-1">Akta Kelahiran</label> 
                    <input type="file" name="file_akte" class="w-full border-gray-300 rounded-lg p-2.5 bg-gray-50"> 
                </div> <div> <label class="block text-gray-800 font-medium mb-1">Surat Lainnya</label> 
                    <input type="file" name="file_surat_lain" class="w-full border-gray-300 rounded-lg p-2.5 bg-gray-50"> 
                </div> 
            </div> 
        </section>

            <!-- Tombol -->
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('user.beranda') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-full transition-all duration-300">
                    ← Kembali
                </a>

                <button type="submit" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-full shadow-lg transition-all duration-300">
                    Daftar
                </button>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>

</body>
</html>
