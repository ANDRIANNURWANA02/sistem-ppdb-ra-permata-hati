<x-guest-layout>

    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">

            <div class="text-center">
                <h2 class="mt-4 text-2xl font-bold text-yellow-400">Lupa Password</h2>
                <p class="text-gray-400 text-sm">Masukkan email Anda untuk menerima link reset password</p>
            </div>

            @if(session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 text-sm rounded-lg text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-semibold py-2 rounded-lg transition transform hover:scale-105">
                        Kirim Link Reset Password
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:underline">Kembali ke login</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
