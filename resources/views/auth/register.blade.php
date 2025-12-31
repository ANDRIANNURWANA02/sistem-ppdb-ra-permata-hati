<x-guest-layout>

    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="text-center mb-6">
            <img src="{{ asset('img/logora.png') }}" alt="Logo RA Permata Hati"
                class="mx-auto h-20 w-20 rounded-full border-4 border-yellow-400 shadow-md">
            <h2 class="mt-4 text-3xl font-bold text-white">Register</h2>
            <p class="text-yellow-50 text-sm">RA Permata Hati</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block  font-semibold mb-1">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-yellow-400"
                        required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block  font-semibold mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-yellow-400"
                        required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-4">
                    <label for="nomor_telepon" class="block  font-semibold mb-1">Nomor Telepon</label>
                    <input id="nomor_telepon" name="nomor_telepon" type="text" value="{{ old('nomor_telepon') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-yellow-400"
                        required autocomplete="tel">
                    <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block font-semibold mb-1">Password</label>

                    <input id="password" name="password" type="password"
                        class="w-full border border-gray-300 rounded-lg p-2 pr-10 focus:outline-none focus:ring-yellow-400"
                        required autocomplete="new-password">

                    <!-- Icon Mata -->
                    <button type="button" onclick="togglePassword('password', 'eye-password', 'eye-off-password')"
                        class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">

                        <!-- Eye -->
                        <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                   c4.478 0 8.268 2.943 9.542 7
                   -1.274 4.057-5.064 7-9.542 7
                   -4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Eye Off -->
                        <svg id="eye-off-password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                   c-4.478 0-8.268-2.943-9.543-7
                   a9.956 9.956 0 012.362-3.568" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.223 6.223A9.953 9.953 0 0112 5
                   c4.478 0 8.268 2.943 9.543 7
                   a9.956 9.956 0 01-4.293 5.774" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-6 relative">
                    <label for="password_confirmation" class="block font-semibold mb-1">
                        Confirm Password
                    </label>

                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="w-full border border-gray-300 rounded-lg p-2 pr-10 focus:outline-none focus:ring-yellow-400"
                        required autocomplete="new-password">

                    <button type="button"
                        onclick="togglePassword('password_confirmation', 'eye-confirm', 'eye-off-confirm')"
                        class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">

                        <svg id="eye-confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                   c4.478 0 8.268 2.943 9.542 7
                   -1.274 4.057-5.064 7-9.542 7
                   -4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <svg id="eye-off-confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-yellow-600 hover:underline" href="{{ route('login') }}">
                        {{ __('Sudah punya akun?') }}
                    </a>

                    <x-primary-button class="!bg-yellow-500 !text-white !hover:bg-yellow-600 px-5 py-2 rounded-lg">
                        {{ __('Register') }}
                    </x-primary-button>

                </div>

            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId, eyeId, eyeOffId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);
            const eyeOff = document.getElementById(eyeOffId);

            if (input.type === "password") {
                input.type = "text";
                eye.classList.add("hidden");
                eyeOff.classList.remove("hidden");
            } else {
                input.type = "password";
                eye.classList.remove("hidden");
                eyeOff.classList.add("hidden");
            }
        }
    </script>

</x-guest-layout>