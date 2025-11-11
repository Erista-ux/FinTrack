<header class="gradient-bg text-white">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold">Fintrack</h1>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-pink-200 transition {{ request()->routeIs('home') ? 'text-pink-200 font-semibold' : '' }}">Beranda</a>
                    <a href="{{ route('features') }}" class="hover:text-pink-200 transition {{ request()->routeIs('features') ? 'text-pink-200 font-semibold' : '' }}">Fitur</a>
                    <a href="{{ route('about') }}" class="hover:text-pink-200 transition {{ request()->routeIs('about') ? 'text-pink-200 font-semibold' : '' }}">Tentang</a>
                    <a href="{{ route('testimonial') }}" class="hover:text-pink-200 transition {{ request()->routeIs('testimonial') ? 'text-pink-200 font-semibold' : '' }}">Testimoni</a>
                    <a href="{{ route('contact') }}" class="hover:text-pink-200 transition {{ request()->routeIs('contact') ? 'text-pink-200 font-semibold' : '' }}">Kontak</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                @if(session('logged_in'))
                    <span class="text-pink-200">Halo, {{ session('username') }}</span>
                    <a href="{{ route('logout') }}" class="bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Logout
                    </a>
                @else
                    <a href="{{ route('login.index') }}" class="hover:text-pink-200 transition">Login</a>
                    <a href="{{ route('signup.index') }}" class="bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Daftar
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
