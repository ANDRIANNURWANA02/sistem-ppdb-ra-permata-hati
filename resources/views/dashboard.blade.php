@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-white">📋 Data Pendaftaran Siswa</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- 🔍 Form Pencarian & Filter -->
        <form method="GET" action="{{ route('admin.dashboard') }}"
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 bg-white p-4 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row md:items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Berdasarkan Nama..."
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200 w-full md:w-64">

                <select name="jenis_kelamin" class="border border-gray-300 rounded-lg px-3 py-2 w-full md:w-48">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>

                <select name="agama" class="border border-gray-300 rounded-lg px-3 py-2 w-full md:w-48">
                    <option value="">Semua Agama</option>
                    <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>


            <button type="submit"
                class="mt-3 md:mt-0 border border-blue-600 text-blue-600 px-5 py-2 rounded-lg hover:bg-blue-50 transition">
                🔍 Cari
            </button>
        </form>
        <!-- Tombol Export -->
        <div class="mb-4 flex flex-wrap gap-3">
            <a href="{{ route('export.excel') }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                📊 Download Data Pendaftaran
            </a>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg text-sm">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-5 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Nama Lengkap</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Jenis Kelamin</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Tempat Lahir</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Tanggal Lahir</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Agama</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Alamat</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Nama Ayah</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Nama Ibu</th>
                        {{-- <th class="px-5 py-3 text-left text-sm font-semibold">Status</th> --}}
                        {{-- <th class="px-5 py-3 text-left text-sm font-semibold">Catatan Admin</th> --}}
                        {{-- <th class="px-5 py-3 text-left text-sm font-semibold">Verifikasi</th> --}}
                        <th class="px-5 py-3 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftarans as $index => $pendaftaran)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-5 py-3">{{ $index + 1 }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->nama_lengkap }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->jenis_kelamin }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->tempat_lahir }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->tanggal_lahir }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->agama }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->alamat_lengkap }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->nama_ayah }}</td>
                            <td class="px-5 py-3">{{ $pendaftaran->nama_ibu }}</td>
                            {{-- <td class="px-5 py-3">
                                @if($pendaftaran->status_verifikasi == 'menunggu')
                                    <span class="bg-gray-800 ml-2 px-3 py-1 rounded-full text-white text-xs">Pending</span>
                                @elseif($pendaftaran->status_verifikasi == 'lolos')
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Lolos</span>
                                @else
                                    <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Perbaikan</span>
                                @endif
                            </td> --}}
                            {{-- <td class="px-5 py-3">
                                {{ $pendaftaran->catatan_admin ?? '-' }}
                            </td> --}}
                            {{-- <td class="px-5 py-3">
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

                                    <button class="bg-yellow-500 text-white w-full py-1 rounded text-sm">
                                        Simpan
                                    </button>
                            </form>
                            </td> --}}

                            <td class="px-5 py-3">
                                {{-- Tombol Detail --}}
                                <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}"
                                    class="block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm text-center mb-1">Detail</a>

                                <!-- Tombol Edit -->
                                <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}"
                                    class="block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm text-center mb-1">Edit</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm mb-1">Hapus</button>
                                </form>

                                <!-- Tombol Download KK -->
                                @if($pendaftaran->file_kk)
                                    <a href="{{ route('pendaftaran.download', ['jenis' => 'kk', 'id' => $pendaftaran->id]) }}"
                                        class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">
                                        Download KK
                                    </a>
                                @else
                                    <span class="block text-gray-400 text-sm text-center">KK Tidak ada</span>
                                @endif

                                <!-- Tombol Download Akte -->
                                @if($pendaftaran->file_akte)
                                    <a href="{{ route('pendaftaran.download', ['jenis' => 'akte', 'id' => $pendaftaran->id]) }}"
                                        class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">
                                        Download Akte
                                    </a>
                                @else
                                    <span class="block text-gray-400 text-sm text-center">Akte Tidak ada</span>
                                @endif

                                <!-- Tombol Download File Lainnya -->
                                @if($pendaftaran->file_surat_lain)
                                    <a href="{{ route('pendaftaran.download', ['jenis' => 'lain', 'id' => $pendaftaran->id]) }}"
                                        class="block bg-green-500 text-white hover:bg-green-600 border border-gray-500 shadow-md px-3 py-1 rounded text-sm text-center mb-1">
                                        Download Lainnya
                                    </a>
                                @else
                                    <span class="block text-gray-400 text-sm text-center">Tidak ada file lain</span>
                                @endif
                            </td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection