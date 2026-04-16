<nav class="bg-gray-900 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16">

            <!-- LOGO (KIRI) -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logora.png') }}" class="h-10 w-auto" alt="Logo">
                <span class="text-lg font-semibold text-white dark:text-white">
                    RA Permata Hati
                </span>
            </div>

            <!-- MENU DESKTOP (KANAN) -->
            <div class="hidden sm:flex items-center space-x-6 ms-auto">

                @guest
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                    <a href="#tentang" class="nav-link">Tentang</a>
                    <a href="#kegiatan" class="nav-link">Kegiatan</a>
                    <a href="#fasilitas" class="nav-link">Fasilitas</a>

                    <a href="{{ route('login') }}" class="font-semibold text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a>
                @else
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ url('/user/beranda') }}" class="nav-link text-white">
                            Beranda
                        </a>
                    @endif

                    <!-- DROPDOWN PROFIL -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-white">
                                {{ Auth::user()->name }}
                                <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profil Saya
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- HAMBURGER MOBILE -->
            <div class="flex items-center sm:hidden ms-auto">
                <button id="menu-toggle"
                    class="text-white dark:text-white text-3xl focus:outline-none">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- MENU MOBILE -->
    <div id="mobile-menu" class="hidden sm:hidden bg-gray-900 px-6 py-6 space-y-4">

        @guest
            <a href="{{ url('/') }}" class="block text-white text-base font-medium">
                Beranda
            </a>
            <a href="#tentang" class="block text-white text-base font-medium">
                Tentang
            </a>
            <a href="#kegiatan" class="block text-white text-base font-medium">
                Kegiatan
            </a>
            <a href="#fasilitas" class="block text-white text-base font-medium">
                Fasilitas
            </a>

            <a href="{{ route('login') }}"
                class="block text-center bg-orange-500 text-white py-2 rounded-lg font-semibold">
                Login
            </a>
        @else
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block text-white text-base font-medium">
                    Dashboard Admin
                </a>
            @else
                <a href="{{ url('/user/beranda') }}" class="block text-white text-base font-medium">
                    Beranda
                </a>
            @endif

            <a href="{{ route('profile.edit') }}" class="block text-white text-base font-medium">
                Profil Saya
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold mt-4">
                    Logout
                </button>
            </form>
        @endguest
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
    
        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
    </script>
    <script defer>
    const toggleBtn = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    toggleBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

</nav>


