@extends('layouts.app')
@section('title', 'Admin Dashboard — Madura Mart')

@section('content')
{{-- Header --}}
<div class="bg-gradient-to-r from-gray-900 via-red-900 to-red-800 rounded-2xl p-6 md:p-8 text-white shadow-xl mb-8 relative overflow-hidden">
    <div class="absolute right-0 top-0 w-72 h-72 bg-white/5 rounded-full -translate-y-36 translate-x-36"></div>
    <div class="absolute left-0 bottom-0 w-48 h-48 bg-yellow-400/5 rounded-full translate-y-24 -translate-x-24"></div>
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-400/20 border border-yellow-400/40 text-yellow-300 text-xs font-semibold mb-3">
                👑 Admin Panel
            </div>
            <h1 class="text-2xl md:text-3xl font-bold">Selamat Datang, {{ auth()->user()->name }}</h1>
            <p class="text-red-200 text-sm mt-1">Panel kendali Madura Mart — {{ now()->format('l, d F Y') }}</p>
        </div>
        <div class="hidden md:flex items-center justify-center w-20 h-20 bg-yellow-400/20 rounded-full border-2 border-yellow-400/40">
            <span class="text-4xl">⚙️</span>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-8">

    {{-- Total Users --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full font-medium">Users</span>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
        <p class="text-sm text-gray-500 mt-0.5">Total User Terdaftar</p>
    </div>

    {{-- Total Products --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <span class="text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded-full font-medium">Produk</span>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['total_products'] }}</p>
        <p class="text-sm text-gray-500 mt-0.5">Total Produk Aktif</p>
    </div>

    {{-- Total Orders --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <span class="text-xs text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded-full font-medium">Pesanan</span>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['total_orders'] }}</p>
        <p class="text-sm text-gray-500 mt-0.5">Total Pesanan Masuk</p>
    </div>

    {{-- Total Admins --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <span class="text-xs text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full font-medium">Admin</span>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['total_admins'] }}</p>
        <p class="text-sm text-gray-500 mt-0.5">Total Administrator</p>
    </div>
</div>

{{-- Quick Links & Recent Users --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Quick Links --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-base font-bold text-gray-800 mb-4">⚡ Aksi Cepat</h2>
        <div class="space-y-2">
            <a href="{{ route('admin.users') }}"   class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition group">
                <span class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-600 transition-colors text-blue-600 group-hover:text-white text-sm">👥</span>
                <div><p class="text-sm font-medium text-gray-700">Kelola Users</p><p class="text-xs text-gray-400">Lihat semua pengguna</p></div>
                <svg class="w-4 h-4 text-gray-300 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('admin.orders') }}"  class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition group">
                <span class="w-9 h-9 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-500 transition-colors text-yellow-600 group-hover:text-white text-sm">📦</span>
                <div><p class="text-sm font-medium text-gray-700">Kelola Pesanan</p><p class="text-xs text-gray-400">Manajemen order masuk</p></div>
                <svg class="w-4 h-4 text-gray-300 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition group">
                <span class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-600 transition-colors text-red-600 group-hover:text-white text-sm">🛒</span>
                <div><p class="text-sm font-medium text-gray-700">Kelola Produk</p><p class="text-xs text-gray-400">Tambah & edit produk</p></div>
                <svg class="w-4 h-4 text-gray-300 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    {{-- Recent Users --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-bold text-gray-800">👥 User Terbaru</h2>
            <a href="{{ route('admin.users') }}" class="text-sm text-red-600 hover:underline font-medium">Lihat semua →</a>
        </div>
        @if($latestUsers->isEmpty())
            <div class="text-center py-8 text-gray-400">
                <p class="text-4xl mb-2">👤</p>
                <p class="text-sm">Belum ada user terdaftar</p>
            </div>
        @else
        <div class="space-y-3">
            @foreach($latestUsers as $u)
            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-400 to-red-700 flex items-center justify-center text-white font-bold text-sm shrink-0">
                    {{ strtoupper(substr($u->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $u->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ $u->email }}</p>
                </div>
                <span class="text-xs px-2 py-1 rounded-full bg-blue-50 text-blue-600 font-medium shrink-0">{{ ucfirst($u->role) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
