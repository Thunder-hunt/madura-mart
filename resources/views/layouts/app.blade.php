<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Madura Mart') — Marketplace Terpercaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'mm-red':  '#C0392B',
                        'mm-dark': '#922B21',
                        'mm-gold': '#F39C12',
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .nav-bg { background: linear-gradient(135deg, #C0392B 0%, #7B241C 100%); }
        .flash-in { animation: fadeDown .4s ease both; }
        @keyframes fadeDown {
            from { opacity:0; transform:translateY(-8px); }
            to   { opacity:1; transform:translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

{{-- NAVBAR --}}
<nav class="nav-bg shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Brand --}}
            <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->check() ? route('dashboard') : route('login')) }}"
               class="flex items-center space-x-2">
                <div class="w-9 h-9 bg-yellow-400 rounded-full flex items-center justify-center shadow">
                    <span class="text-red-800 font-black text-lg">M</span>
                </div>
                <div class="leading-tight">
                    <span class="text-white font-bold text-lg block">Madura Mart</span>
                    <span class="text-yellow-300 text-xs block">Marketplace Terpercaya</span>
                </div>
            </a>

            {{-- Nav Links --}}
            @auth
            <div class="hidden md:flex items-center space-x-1">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-red-100 hover:text-white hover:bg-red-800/40 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-800/40 text-white' : '' }}">📊 Dashboard</a>
                    <a href="{{ route('admin.users') }}"    class="text-red-100 hover:text-white hover:bg-red-800/40 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('admin.users') ? 'bg-red-800/40 text-white' : '' }}">👥 Users</a>
                    <a href="{{ route('admin.orders') }}"   class="text-red-100 hover:text-white hover:bg-red-800/40 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('admin.orders') ? 'bg-red-800/40 text-white' : '' }}">📦 Pesanan</a>
                @else
                    <a href="{{ route('dashboard') }}"      class="text-red-100 hover:text-white hover:bg-red-800/40 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-red-800/40 text-white' : '' }}">🏠 Dashboard</a>
                    <a href="{{ route('products.index') }}" class="text-red-100 hover:text-white hover:bg-red-800/40 px-3 py-2 rounded-md text-sm font-medium transition">🛒 Produk</a>
                @endif
            </div>

            {{-- User Menu --}}
            <div class="flex items-center space-x-3">
                <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                    {{ auth()->user()->isAdmin() ? 'bg-yellow-400 text-yellow-900' : 'bg-white/20 text-white' }}">
                    {{ auth()->user()->isAdmin() ? '👑 Admin' : '👤 User' }}
                </span>
                <span class="text-white text-sm font-medium hidden sm:block truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 bg-white/10 hover:bg-white/25 text-white px-3 py-1.5 rounded-md text-sm font-medium transition border border-white/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
            @endauth

        </div>
    </div>
</nav>

{{-- FLASH MESSAGES --}}
<div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-4">
    @if(session('success'))
        <div class="flash-in flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 shadow-sm">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="text-sm font-medium flex-1">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-green-600 font-bold">✕</button>
        </div>
    @endif
    @if(session('error'))
        <div class="flash-in flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 shadow-sm">
            <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <span class="text-sm font-medium flex-1">{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 font-bold">✕</button>
        </div>
    @endif
</div>

{{-- CONTENT --}}
<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-gray-800 text-gray-400 py-6 mt-auto">
    <div class="max-w-7xl mx-auto px-4 text-center text-sm">
        © {{ date('Y') }} <span class="text-yellow-400 font-semibold">Madura Mart</span> — Marketplace Terpercaya Produk Madura
    </div>
</footer>

@stack('scripts')
</body>
</html>
