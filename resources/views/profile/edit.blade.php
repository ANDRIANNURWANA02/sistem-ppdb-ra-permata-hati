@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">
            👤 Edit Profil {{ Auth::user()->role === 'admin' ? 'Admin' : 'User' }}
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- ================= DATA DASAR ================= -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ================= GANTI PASSWORD ================= -->
            <div class="mt-10 border-t pt-6">
                <h2 class="text-lg font-bold mb-4 text-gray-700">
                    🔐 Ganti Password
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="relative">
                        <label class="block text-sm font-semibold mb-1">
                            Password Baru
                        </label>

                        <input type="password" id="new_password" name="new_password"
                            class="w-full pr-12 px-4 py-2 border rounded-lg focus:ring focus:ring-yellow-400"
                            placeholder="Masukkan password baru">

                        <!-- ICON MATA -->
                        <button type="button" onclick="togglePassword('new_password', this)"
                            class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">
                            <!-- Eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-open" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                           c4.478 0 8.268 2.943 9.542 7
                           -1.274 4.057-5.064 7-9.542 7
                           -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <!-- Eye Off -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden eye-closed" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M9.88 9.88A3 3 0 0114.12 14.12
                           M10.73 5.08A10.43 10.43 0 0112 5
                           c4.48 0 8.27 2.94 9.54 7
                           a9.97 9.97 0 01-4.29 5.04
                           M6.23 6.23A9.97 9.97 0 002.46 12
                           c1.27 4.06 5.06 7 9.54 7
                           a10.43 10.43 0 004.27-.91" />
                            </svg>
                        </button>
                    </div>


                    <div class="relative">
                        <label class="block text-sm font-semibold mb-1">
                            Konfirmasi Password Baru
                        </label>

                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            class="w-full pr-12 px-4 py-2 border rounded-lg focus:ring focus:ring-yellow-400"
                            placeholder="Ulangi password baru">

                        <button type="button" onclick="togglePassword('new_password_confirmation', this)"
                            class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">
                            <!-- Eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-open" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.478 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.064 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <!-- Eye Off -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden eye-closed" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M9.88 9.88A3 3 0 0114.12 14.12
                       M10.73 5.08A10.43 10.43 0 0112 5
                       c4.48 0 8.27 2.94 9.54 7
                       a9.97 9.97 0 01-4.29 5.04
                       M6.23 6.23A9.97 9.97 0 002.46 12
                       c1.27 4.06 5.06 7 9.54 7
                       a10.43 10.43 0 004.27-.91" />
                            </svg>
                        </button>
                    </div>


                </div>
            </div>

            <!-- ================= TOMBOL ================= -->
            <div class="mt-8 flex justify-end">
                <button
                    class="bg-orange-500 text-white hover:bg-orange-600 transition shadow-md text-white px-6 py-2 rounded-lg font-semibold">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <!-- ================= SCRIPT TOGGLE PASSWORD ================= -->
    <script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const eyeOpen = button.querySelector('.eye-open');
        const eyeClosed = button.querySelector('.eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }
</script>

@endsection