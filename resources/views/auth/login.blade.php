<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">
            <!-- Logo -->
            <div class="text-center">
                <img src="{{ asset('img/logora.png') }}" alt="Logo RA Permata Hati"
                    class="mx-auto h-20 w-20 rounded-full border-4 border-yellow-400 shadow-md">
                <h2 class="mt-4 text-2xl font-bold text-yellow-400">Login</h2>
                <p class="text-gray-400 text-sm">RA Permata Hati</p>
            </div>

            @if($errors->has('login_error'))
                <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                    <span class="text-lg">❌</span>
                    <span>{{ $errors->first('login_error') }}</span>
                </div>
            @endif

            <script>
                setTimeout(() => {
                    document.querySelectorAll('.bg-red-100,.bg-red-50').forEach(el => el.remove());
                }, 5000);
            </script>


            <div class="w-full max-w-md bg-white rounded-2xl">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 text-sm rounded-lg text-center">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>

                        <input id="password" name="password" type="password" required class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-12
               focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">

                        <!-- Icon Mata -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <!-- Eye Open -->
                                <path id="eyeOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path id="eyeOpen2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                   c4.478 0 8.268 2.943 9.542 7
                   -1.274 4.057-5.064 7-9.542 7
                   -4.477 0-8.268-2.943-9.542-7z" />

                                <!-- Eye Closed -->
                                <path id="eyeClosed" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                   c-4.478 0-8.268-2.943-9.542-7
                   a9.956 9.956 0 012.042-3.368M6.223 6.223
                   A9.956 9.956 0 0112 5
                   c4.478 0 8.268 2.943 9.542 7
                   a9.96 9.96 0 01-4.042 5.132M15 12
                   a3 3 0 00-3-3M3 3l18 18" />
                            </svg>
                        </button>
                    </div>


                    <!-- Remember Me + Lupa Password -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 text-indigo-600 border-gray-300 rounded">
                            <span class="text-gray-700">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-yellow-600 hover:underline">
                                Lupa password?
                            </a>
                        @endif
                    </div>


                    <!-- Tombol Login -->
                    <div>
                        <button type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-semibold py-2 rounded-lg transition transform hover:scale-105">
                            Masuk
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('register') }}" class="hover:underline">Belum punya akun? Daftar di sini</a>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="text-gray-600 text-sm">
                            ← Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function togglePassword() {
                const password = document.getElementById('password');
                const eyeOpen = document.getElementById('eyeOpen');
                const eyeOpen2 = document.getElementById('eyeOpen2');
                const eyeClosed = document.getElementById('eyeClosed');

                if (password.type === 'password') {
                    password.type = 'text';
                    eyeOpen.classList.add('hidden');
                    eyeOpen2.classList.add('hidden');
                    eyeClosed.classList.remove('hidden');
                } else {
                    password.type = 'password';
                    eyeOpen.classList.remove('hidden');
                    eyeOpen2.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                }
            }
        </script>

</x-guest-layout>