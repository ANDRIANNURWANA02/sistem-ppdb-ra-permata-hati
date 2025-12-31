<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LOGO -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logora.png') }}" class="h-10 w-auto" alt="Logo">
                <span class="text-lg font-semibold text-gray-800 dark:text-white">
                    RA Permata Hati
                </span>
            </div>

            <!-- HAMBURGER MOBILE -->
            <div class="flex items-center sm:hidden">
                <button id="menu-toggle" class="text-gray-700 dark:text-white text-3xl focus:outline-none">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- MENU DESKTOP -->
    <div class="hidden sm:flex sm:items-center sm:space-x-6">

        @guest
            <a href="{{ url('/') }}" class="nav-link">Beranda</a>
            <a href="#tentang" class="nav-link">Tentang</a>
            <a href="#kegiatan" class="nav-link">Kegiatan</a>
            <a href="#fasilitas" class="nav-link">Fasilitas</a>

            <a href="{{ route('login') }}" class="font-semibold text-blue-600">Login</a>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a>
        @else
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard Admin</a>
            @else
                <a href="{{ url('/user/beranda') }}" class="nav-link">Beranda</a>
            @endif

            <!-- DROPDOWN PROFILE -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white">
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

            <a href="{{ route('login') }}" class="block text-center bg-orange-500 text-white py-2 rounded-lg font-semibold">
                Login
            </a>
        @else
            {{-- USER / ADMIN --}}
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

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold mt-4">
                    Logout
                </button>
            </form>
        @endguest
    </div>
</nav>