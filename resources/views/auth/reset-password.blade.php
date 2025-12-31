<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">

            <h2 class="text-2xl font-bold text-center text-yellow-500 mb-4">Reset Password</h2>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-yellow-400"
                        value="{{ old('email') }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-semibold mb-1">Password Baru</label>
                    <input type="password" name="password" id="password"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-yellow-400" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block font-semibold mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full border border-gray-300 p-2 rounded focus:ring-yellow-400" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('login') }}" class="text-yellow-500 hover:underline text-sm">
                        ← Kembali ke Login
                    </a>

                    <x-primary-button class="!bg-yellow-500 !text-white !hover:bg-yellow-600 px-5 py-2 rounded-lg">
                        Reset Password
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
