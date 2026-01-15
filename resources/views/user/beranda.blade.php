<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda User - RA Permata Hati</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">

    {{-- ================= HEADER ================= --}}
    <!-- Header -->
    <header class="bg-gray-900 shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center p-4 md:p-6">

            <!-- Logo -->
            <div class="flex items-center gap-5">
                <img src="{{ asset('img/logora.png') }}" alt="Logo Sekolah" class="h-14 w-auto ">
                <span class="text-lg font-semibold text-white">
                    RA Permata Hati
                </span>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center mt-4 mx-4"
                    role="alert"> <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- HAMBURGER BUTTON (Mobile) -->
            <button id="menu-toggle" class="md:hidden text-white focus:outline-none text-3xl">
                ☰ </button>

            <!-- NAV LINKS -->
            <nav id="menu" class="hidden md:flex space-x-6 text-white items-center">
                @auth
                    <a href="{{ route('user.dashboard') }}#status"
                        class=" text-gray-800 dark:text-gray-300 hover:text-white transition">
                        Detail Pendaftaran
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </nav>
        </div>

        <!-- MENU MOBILE -->
        <div id="mobile-menu" class="md:hidden hidden bg-gray-800 text-white px-6 py-4 space-y-4">
            @auth
                <a href="{{ route('user.dashboard') }}#status"
                        class=" text-gray-700 dark:text-gray-300 hover:text-white transition">
                        Detail Pendaftaran
                    </a>
                <form action="{{ route('logout') }}" method="POST"> @csrf <button type="submit"
                        class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"> Logout
                    </button>
                </form>
            @endauth
        </div>
    </header>

    <!-- SCRIPT UNTUK TOGGLE MENU -->
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () { const menu = document.getElementById('mobile-menu'); menu.classList.toggle('hidden'); });
    </script>


    {{-- ================= HERO ================= --}}
    <section class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                Selamat Datang, <br> {{ Auth::user()->name }} 👋
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto">
                Pantau status pendaftaran, lengkapi data, dan lihat hasil verifikasi dari admin
                melalui sistem pendaftaran RA Permata Hati.
            </p>
        </div>
    </section>
    {{-- ================= STATUS PENDAFTARAN ================= --}}

    @if(!$pendaftaran)
        <!-- USER BELUM MENDAFTAR -->
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
        {{-- JIKA SUDAH DAFTAR --}}
        <div class="bg-white p-6 rounded-2xl shadow">

            <section class="container mx-auto px-6 py-16">
                <div class="bg-white rounded-2xl shadow-md p-8">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">
                            Data Pendaftaran
                        </h2>

                        {{-- Tombol Edit --}}
                        @if($pendaftaran)
                            @if($pendaftaran->status_verifikasi === 'perlu_perbaikan')
                                <a href="{{ route('user.pendaftaran.edit', $pendaftaran->id) }}"
                                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow">
                                    Perbaiki Data
                                </a>

                            @elseif($pendaftaran->status_verifikasi === 'lolos')
                                <button
                                    class="bg-gray-300 text-gray-600 px-5 py-2 rounded-lg text-sm font-semibold cursor-not-allowed"
                                    disabled title="Data sudah diverifikasi dan tidak dapat diubah">
                                    ✔ Data Terkunci
                                </button>
                            @endif
                        @endif
                    </div>

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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <p class="text-gray-500">Nama Lengkap</p>
                            <p class="font-semibold">{{ $pendaftaran->nama_lengkap }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Alamat Lengkap</p>
                            <p class="font-semibold">{{ $pendaftaran->alamat_lengkap }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Tempat, Tanggal Lahir</p>
                            <p class="font-semibold">
                                {{ $pendaftaran->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Jenis Kelamin</p>
                            <p class="font-semibold">{{ $pendaftaran->jenis_kelamin }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Nama Ayah</p>
                            <p class="font-semibold">{{ $pendaftaran->nama_ayah }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Nama Ibu</p>
                            <p class="font-semibold">{{ $pendaftaran->nama_ibu }}</p>
                        </div>
                    </div>
            </section>
    @endif

        {{-- ================= ALUR ================= --}}
        <section class="bg-white py-16 border-t">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-2xl font-bold mb-10">Alur Pendaftaran</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm">
                    <div class="p-6 rounded-xl bg-gray-50">
                        📝<br><b>Isi Formulir</b>
                    </div>
                    <div class="p-6 rounded-xl bg-gray-50">
                        📤<br><b>Kirim Data</b>
                    </div>
                    <div class="p-6 rounded-xl bg-gray-50">
                        🔍<br><b>Verifikasi Admin</b>
                    </div>
                    <div class="p-6 rounded-xl bg-gray-50">
                        🎉<br><b>Pengumuman</b>
                    </div>
                </div>
            </div>
        </section>


       <!-- Tombol Chatbot -->
    <a href="https://nurwana02.app.n8n.cloud/webhook/ac67d7fc-1428-4fb5-9295-c8284a991857/chat" class="fixed bottom-6 right-6 bg-orange-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-orange-600 transition">
        💬 Bantuan
    </a>

</body>

</html>