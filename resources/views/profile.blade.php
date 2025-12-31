<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RA Permata Hati</title>
    @vite('resources/css/app.css')

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    <!-- ================= HEADER / NAVBAR ================= -->
    <header class="bg-gray-900 sticky top-0 z-50 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">

            <!-- LOGO -->
            <div class="flex items-center gap-4">
                <img src="{{ asset('img/logora.png') }}" class="h-12" alt="Logo">
                <span class="text-white font-semibold text-lg">
                    RA Permata Hati
                </span>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center mt-4 mx-4"
                    role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <!-- HAMBURGER (MOBILE) -->
            <button id="menu-toggle" class="md:hidden text-white text-3xl focus:outline-none">
                ☰
            </button>

            <!-- NAV DESKTOP -->
            <nav class="hidden md:flex items-center space-x-6 text-white">
                <a href="#profil" class="hover:text-yellow-400">Beranda</a>
                <a href="#tentang" class="hover:text-yellow-400">Tentang</a>
                <a href="#fasilitas" class="hover:text-yellow-400">Fasilitas</a>
                <a href="#kegiatan" class="hover:text-yellow-400">Kegiatan</a>
                    <a href="{{ route('login') }}"
                        class="bg-orange-500 px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition">
                        Login
                    </a>
            </nav>
        </div>

        <!-- MENU MOBILE -->
        <div id="mobile-menu" class="md:hidden hidden bg-gray-800 text-white px-6 py-6 space-y-4">
            <a href="#profil" class="block hover:text-yellow-400">Beranda</a>
            <a href="#tentang" class="block hover:text-yellow-400">Tentang</a>
            <a href="#fasilitas" class="block hover:text-yellow-400">Fasilitas</a>
            <a href="#kegiatan" class="block hover:text-yellow-400">Kegiatan</a>

                <a href="{{ route('login') }}"
                    class="block text-center bg-orange-500 px-4 py-2 rounded-lg font-semibold hover:bg-orange-600">
                    Login
                </a>
            
        </div>
    </header>

    <!-- Tombol Chatbot -->
    <button id="chatbotButton"
        class="fixed bottom-6 right-6 bg-orange-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-orange-600 transition">
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

            // kirim ke N8N
            const response = await fetch('https://n8n-ftnqmvzgt6pp.timah.sumopod.my.id/webhook/9ca0aac1-2cc5-4f7e-a2ec-a4e346efda26/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message })
            });

            const data = await response.json();

            // tampilkan balasan chatbot
            chatMessages.innerHTML += `
  <div class="text-left mb-2">
    <span class="bg-gray-100 px-3 py-1 rounded-lg inline-block">
      ${data.reply || 'Bot belum merespons.'}
    </span>
  </div>
`;
            chatMessages.scrollTop = chatMessages.scrollHeight;

        });
    </script>


    <!-- ================= HERO ================= -->
    <!-- Hero Section -->
    <section id="profil" class="relative bg-cover bg-center h-[60vh]"
        style="background-image: url('https://i0.wp.com/nos.jkt-1.neo.id/artikel/2024/06/perbedaan-sekolah-TK-dan-RA.jpg?fit=740%2C493&ssl=1');">

        <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-center items-center text-center px-4">

            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4">
                Selamat Datang di RA Permata Hati
            </h2>

            <p id="tentang" class="text-gray-200 text-lg max-w-2xl mb-6">
                Tempat tumbuhnya generasi cerdas, ceria, dan berakhlak mulia.
            </p>

            {{-- BUTTON DAFTAR SEKARANG --}}
            @guest
                <a href="{{ route('pendaftaran.index') }}" class="bg-orange-500 text-white font-bold px-8 py-3 rounded-full text-lg
                                       hover:bg-yellow-500 transition duration-300 shadow-lg" id="tentang">
                    Daftar Sekarang
                </a>
            @endguest

            @auth
                <a href="{{ route('pendaftaran.index') }}" class="bg-orange-500 text-white font-bold px-8 py-3 rounded-full text-lg
                                       hover:bg-yellow-500 transition duration-300 shadow-lg">
                    Daftar Sekarang
                </a>
            @endauth

        </div>
    </section>


    <!-- Profil Singkat -->
    <section class="py-16 px-6 md:px-20 bg-white text-gray-700">
        <div class="max-w-5xl mx-auto text-center">
            <h3 class="text-3xl font-bold text-yellow-500 mb-6">Profil Sekolah</h3>
            <p class="leading-relaxed">
                RA Permata Hati merupakan lembaga pendidikan anak usia dini yang berfokus pada pengembangan karakter,
                kecerdasan emosional, spiritual, dan sosial anak. Dengan lingkungan belajar yang aman, nyaman, dan
                menyenangkan,
                kami berkomitmen menumbuhkan potensi terbaik setiap anak.
            </p>
        </div>
    </section>


    <!-- ===== Bagian Tentang Kami ===== -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-yellow-500 mb-8 text-center">
                Sejarah Perjalanan Berdirinya RA Permata Hati
            </h2>

            <p class="text-gray-700 leading-relaxed mb-4">
                Raudathul Atfhal (RA) Permata Hati didirikan oleh <span class="font-semibold">Bapak H. Usman,
                    S.Ag.</span> pada Bulan Januari Tahun 2005. RA ini awalnya berdiri berdasarkan akta pendirian
                Notaris Zulheri, S.H. Seiring waktu, payung hukum diperkuat dengan Akte Notaris No. 04 dan SK
                Kemenkumham No. AHU.0011207.AH.01.04 Tahun 2016.
            </p>

            <p class="text-gray-700 leading-relaxed mb-4">
                Awalnya hanya ada beberapa kelompok:
            </p>
            <ul class="list-disc list-inside text-gray-700 mb-4">
                <li>Kelompok B: 36 siswa</li>
                <li>Kelompok A: 36 siswa</li>
                <li>Play Group: 36 siswa</li>
            </ul>

            <p class="text-gray-700 leading-relaxed mb-4">
                Tahun 2006 dibuka kelompok <span class="font-semibold">Toddler</span> untuk anak usia 2-3 tahun. Minat
                orang tua semakin meningkat setiap tahun untuk menyekolahkan anaknya di RA Permata Hati.
            </p>

            <p class="text-gray-700 leading-relaxed mb-4">
                Tahun 2010, RA Permata Hati resmi terdaftar di <span class="font-semibold">Kementrian Agama Kota
                    Depok</span>. Pada tahun 2011, RA Permata Hati mendapatkan predikat <span
                    class="font-semibold">Akreditasi A</span> dari <span class="font-semibold">BAN S/M</span> dengan
                nilai 91 poin. Jumlah siswa saat itu mencapai 135, dengan:
            </p>
            <ul class="list-disc list-inside text-gray-700 mb-4">
                <li>3 kelompok B</li>
                <li>5 kelompok A</li>
                <li>1 kelompok Play Group</li>
                <li>1 kelompok Toddler</li>
            </ul>

            <p class="text-gray-700 leading-relaxed mb-4">
                Tahun 2018, RA Permata Hati memperbarui status akreditasinya dan kembali meraih <span
                    class="font-semibold">Akreditasi A</span> dengan nilai 995 poin, menjadi salah satu RA pelopor di
                Kecamatan Cimanggis Kota Depok yang meraih akreditasi sejak 2011.
            </p>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="bg-gray-100 py-16 px-6 md:px-20">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-3xl font-bold text-yellow-500 mb-4">Visi</h3>
                <p class="text-gray-700 leading-relaxed">
                    "Menjadi lembaga pendidikan yang mampu mencetak dan mengembangkan generasi SIAP
                    (Sholeh, Intelek, Amanah, dan Percaya diri)."
                </p>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-yellow-500 mb-4">Misi</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Anak terbiasa mentaati ajaran agama islam dan berbuat baik.</li>
                    <li>Anak memiliki perkembangan kognitif yang baik dan kreatif.</li>
                    <li>Anak dapat dipercaya dan jujur baik dalam perkataan maupun perbuatan.</li>
                    <li>Anak berani tampil di depan orang banyak dan percaya diri.</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Organigram Section -->
    <section id="organigram" class="bg-gray-100 py-16 px-6 md:px-20">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-yellow-500 mb-8">Struktur Organisasi</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                <!-- Anggota 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
                    <img src="{{ asset('images/organigram/ketua.jpg') }}" alt="Ketua"
                        class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-yellow-400">
                    <h3 class="text-xl font-semibold text-gray-800">H. Usman S.Ag.</h3>
                    <p class="text-yellow-500 font-medium">Ketua RA</p>
                </div>

                <!-- Anggota 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
                    <img src="{{ asset('images/organigram/wakil.jpg') }}" alt="Wakil"
                        class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-yellow-400">
                    <h3 class="text-xl font-semibold text-gray-800">Hj. Aulia Prihanti S.Ag.</h3>
                    <p class="text-yellow-500 font-medium">Kepala Sekolah</p>
                </div>

                <!-- Anggota 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
                    <img src="{{ asset('images/organigram/bendahara.jpg') }}" alt="Bendahara"
                        class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-yellow-400">
                    <h3 class="text-xl font-semibold text-gray-800">Afifah Arubani, S.Pd. </h3>
                    <p class="text-yellow-500 font-medium">Operator</p>
                </div>

                <!-- Anggota 4 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
                    <img src="{{ asset('images/organigram/sekretaris.jpg') }}" alt="Sekretaris"
                        class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-yellow-400">
                    <h3 class="text-xl font-semibold text-gray-800">Indriyani Lurita, A.Md.</h3>
                    <p id="fasilitas" class="text-yellow-500 font-medium">Bendahara</p>
                </div>

            </div>
        </div>
    </section>


    <!-- ===== Bagian Fasilitas ===== -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-yellow-500 mb-6 text-center">Fasilitas Sekolah</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- Fasilitas 1 -->
                <div class="rounded-2xl overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/fasilitas/kelas.jpg') }}" alt="Ruang Kelas"
                        class="w-full h-56 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Ruang Kelas Nyaman</h3>
                    </div>
                </div>

                <!-- Fasilitas 2 -->
                <div class="rounded-2xl overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/fasilitas/taman.jpg') }}" alt="Taman Bermain"
                        class="w-full h-56 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Taman Bermain Anak</h3>
                    </div>
                </div>

                <!-- Fasilitas 3 -->
                <div class="rounded-2xl overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/fasilitas/musholla.jpg') }}" alt="Musholla"
                        class="w-full h-56 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Musholla Anak</h3>
                    </div>
                </div>

                <!-- Fasilitas 4 -->
                <div class="rounded-2xl overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/fasilitas/perpustakaan.jpg') }}" alt="Perpustakaan Mini"
                        class="w-full h-56 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Perpustakaan Mini</h3>
                    </div>
                </div>

                <!-- Fasilitas 5 -->
                <div class="rounded-2xl overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/fasilitas/lapangan.jpg') }}" alt="Lapangan Bermain"
                        class="w-full h-56 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold">Lapangan Bermain</h3>
                    </div>
                </div>

                <!-- Fasilitas 6 -->
                <div class="rounded-2xl overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/fasilitas/kantin.jpg') }}" alt="Kantin Sehat"
                        class="w-full h-56 object-cover">
                    <div class="p-4 text-center">
                        <h3 id="kegiatan" class="text-lg font-semibold">Kantin Sehat</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== Bagian Kegiatan ===== -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-yellow-500 mb-6 text-center">Kegiatan Sekolah</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

                <!-- Kegiatan 1 -->
                <div
                    class="bg-white rounded-2xl shadow overflow-hidden hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/kegiatan/mengaji.jpg') }}" alt="Belajar Mengaji"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Belajar Mengaji</h3>
                        <p class="text-gray-600 text-sm">Kegiatan rutin untuk meningkatkan kemampuan baca Al-Qur'an
                            anak-anak.</p>
                    </div>
                </div>

                <!-- Kegiatan 2 -->
                <div
                    class="bg-white rounded-2xl shadow overflow-hidden hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/kegiatan/seni.jpg') }}" alt="Kelas Seni"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Kelas Seni</h3>
                        <p class="text-gray-600 text-sm">Melatih kreativitas anak dalam bidang menggambar dan mewarnai.
                        </p>
                    </div>
                </div>

                <!-- Kegiatan 3 -->
                <div
                    class="bg-white rounded-2xl shadow overflow-hidden hover:scale-105 transform transition duration-300">
                    <img src="{{ asset('images/kegiatan/outing.jpg') }}" alt="Outing Class"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Outing Class</h3>
                        <p class="text-gray-600 text-sm">Belajar di luar kelas untuk mengenal lingkungan dan dunia
                            sekitar.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- Footer Lengkap -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Kolom 1: Kontak, Alamat & Map -->
            <div>
                <h3 class="text-yellow-400 font-bold text-lg mb-4">Kontak & Alamat</h3>
                <ul class="space-y-2">
                    <li>RA Permata Hati</li>
                    <li>
                        <a href="" target="_blank" class="hover:text-yellow-400">
                            Alamat: Jl. Nusantara No.6 Rt 01 Rw 07, Pasir Gunung Selatan, Cimanggis, Kota Depok</a>
                    </li>
                    <li><a href="" target="_blank" class="hover:text-yellow-400">Email:
                            ra.permatahaticimanggis@gmail.com</a></li>
                    <li><a href="" target="_blank" class="hover:text-yellow-400">Telepon: +62 218-7190-14</a></li>
                </ul>

            </div>

            <!-- Kolom 2: Sosial Media -->
            <div>
                <h3 class="text-yellow-400 font-bold text-lg mb-4">Sosial Media</h3>
                <ul class="space-y-2">
                    <li><a href="https://www.facebook.com/RA-Permata-Hati" target="_blank"
                            class="hover:text-yellow-400">Facebook</a></li>
                    <li><a href="https://www.instagram.com/rapermatahati" target="_blank"
                            class="hover:text-yellow-400">Instagram</a></li>
                    <li><a href="https://www.youtube.com/rapermatahati" target="_blank"
                            class="hover:text-yellow-400">YouTube</a></li>
                    <li><a href="https://www.tiktok.com/@rapermatahati" target="_blank"
                            class="hover:text-yellow-400">TikTok</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Akreditasi & Info Sekolah -->
            <div>
                <h3 class="text-yellow-400 font-bold text-lg mb-4">Akreditasi & Info</h3>
                <p class="mb-2">Akreditasi: A</p>
                <p class="mb-2">Buka: Senin - Jumat, 07:15 - 14:00 WIB</p>
                <p class="mb-2">Tutup: Sabtu & Minggu</p>
                <p class="mb-2">Tahun Berdiri: 2005</p>
            </div>

            <!-- Kolom 4: Navigasi Cepat -->
            <div>
                <h3 class="text-yellow-400 font-bold text-lg mb-4">Navigasi Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#profil" class="hover:text-yellow-400">Profil</a></li>
                    <li><a href="#tentang" class="hover:text-yellow-400">Tentang Kami</a></li>
                    <li><a href="#fasilitas" class="hover:text-yellow-400">Fasilitas</a></li>
                    <li><a href="#kegiatan" class="hover:text-yellow-400">Kegiatan</a></li>
                    <li><a href="{{ route('pendaftaran.index') }}" class="hover:text-yellow-400">Pendaftaran</a></li>
                </ul>
            </div>

        </div>

        <!-- Bottom Footer -->
        <div class="mt-8 border-t border-gray-700 pt-4 text-center text-sm text-gray-500">
            © 2025 RA Permata Hati | Semua Hak Dilindungi
        </div>
    </footer>


    <!-- ================= SCRIPT TOGGLE NAVBAR ================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            toggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        });
    </script>

</body>

</html>