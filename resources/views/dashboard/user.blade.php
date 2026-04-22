@extends('layouts.app')
@section('title', 'Dashboard — Madura Mart')

@section('content')
{{-- Welcome Header --}}
<div class="bg-gradient-to-r from-red-700 via-red-600 to-red-800 rounded-2xl p-6 md:p-8 text-white shadow-xl mb-8 relative overflow-hidden">
    <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <p class="text-red-200 text-sm font-medium mb-1">Selamat Datang Kembali 👋</p>
            <h1 class="text-2xl md:text-3xl font-bold">{{ $user->name }}</h1>
            <div class="flex items-center gap-2 mt-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white border border-white/30">
                    👤 User Member
                </span>
                <span class="text-red-200 text-xs">{{ $user->email }}</span>
            </div>
        </div>
        <div class="hidden md:block">
            <div class="w-20 h-20 bg-yellow-400/20 rounded-full flex items-center justify-center border-2 border-yellow-400/40">
                <span class="text-4xl">🛍️</span>
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<h2 class="text-lg font-bold text-gray-700 mb-4">Aksi Cepat</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">

    <a href="{{ route('products.index') }}"
       class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg border border-gray-100 transition-all duration-200 hover:-translate-y-1">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors">
            <svg class="w-6 h-6 text-red-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-1">Browse Produk</h3>
        <p class="text-gray-500 text-sm">Temukan produk unggulan Madura</p>
    </a>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-1">Riwayat Pesanan</h3>
        <p class="text-gray-500 text-sm">Lihat semua pesanan Anda</p>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-1">Profil Saya</h3>
        <p class="text-gray-500 text-sm">Kelola informasi akun Anda</p>
    </div>
</div>

{{-- Account Info --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-base font-bold text-gray-800 mb-5 flex items-center gap-2">
        <span class="w-6 h-6 bg-red-100 rounded-md flex items-center justify-center text-red-600 text-xs">👤</span>
        Informasi Akun
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-4 bg-gray-50 rounded-xl">
            <p class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Nama Lengkap</p>
            <p class="text-gray-800 font-medium">{{ $user->name }}</p>
        </div>
        <div class="p-4 bg-gray-50 rounded-xl">
            <p class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Email</p>
            <p class="text-gray-800 font-medium">{{ $user->email }}</p>
        </div>
        <div class="p-4 bg-gray-50 rounded-xl">
            <p class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Role</p>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">👤 User</span>
        </div>
        <div class="p-4 bg-gray-50 rounded-xl">
            <p class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Bergabung Sejak</p>
            <p class="text-gray-800 font-medium">{{ $user->created_at?->format('d F Y') ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection
