<nav class="gradient-bg text-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-8">
                <h1 class="text-2xl font-bold">Fintrack</h1>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ session('user_type') === 'standard' ? route('home.standard') : route('home.advance') }}"
                       class="hover:text-pink-200 transition {{ request()->routeIs('home.*') ? 'text-pink-200 font-semibold' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('sales.index') }}"
                       class="hover:text-pink-200 transition {{ request()->routeIs('sales.*') ? 'text-pink-200 font-semibold' : '' }}">
                        Penjualan
                    </a>
                    <a href="{{ route('features') }}" class="hover:text-pink-200 transition">Fitur</a>
                    <a href="{{ route('about') }}" class="hover:text-pink-200 transition">Tentang</a>
                    <a href="{{ route('contact') }}" class="hover:text-pink-200 transition">Kontak</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-pink-200 text-sm">Welcome, {{ session('username') }} ({{ session('user_type') }})</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                           class="bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
