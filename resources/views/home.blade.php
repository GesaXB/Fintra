@extends('layouts.app')

@section('title', 'Fintra - Personal Finance Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-green-50">
    <!-- Header -->
    <header class="relative backdrop-blur-md bg-white/80 border-b border-gray-100 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-8 lg:px-12 xl:px-16 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-green-400 to-green-600 bg-clip-text text-transparent">Fintra</span>
                        <div class="text-xs text-gray-500 font-medium">Personal Finance</div>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-400 to-green-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-medium">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-8 lg:px-12 xl:px-16 py-20 lg:py-28">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full border border-green-200">
                    <span class="text-green-600 text-sm font-medium">🚀 Asisten Finansial Digital Terpercaya</span>
                </div>
                
                <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Kelola Keuangan<br>
                    <span class="bg-gradient-to-r from-green-400 to-green-600 bg-clip-text text-transparent">Wujudkan Impian</span>
                </h1>
                
                <p class="text-xl text-gray-600 leading-relaxed max-w-lg">
                    Aplikasi manajemen keuangan pribadi yang membantu Anda mencatat transaksi, mengatur target pengeluaran, dan menganalisis kebiasaan finansial dengan mudah dan praktis.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('register') }}" class="group bg-gradient-to-r from-green-400 to-green-600 text-white px-8 py-4 rounded-xl text-lg font-semibold shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-center relative overflow-hidden">
                        <span class="relative z-10">Mulai Sekarang</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-green-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <button class="group border-2 border-gray-200 text-gray-700 px-8 py-4 rounded-xl text-lg font-semibold hover:border-green-300 hover:bg-green-50 hover:text-green-700 transition-all duration-300 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                        </svg>
                        <span>Lihat Demo</span>
                    </button>
                </div>
                
                <div class="flex items-center space-x-8 pt-8">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">1000+</div>
                        <div class="text-sm text-gray-500">Pengguna Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">50K+</div>
                        <div class="text-sm text-gray-500">Transaksi Tercatat</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">4.8/5</div>
                        <div class="text-sm text-gray-500">Rating Pengguna</div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <!-- Main Dashboard Mockup -->
                <div class="relative bg-white rounded-3xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-green-600 rounded-full"></div>
                            <div>
                                <div class="font-semibold text-gray-900">Dzaky Ahmad</div>
                                <div class="text-sm text-gray-500">Saldo Total</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H4l5-5v5z"/>
                        </svg>
                    </div>
                    
                    <!-- Balance Card -->
                    <div class="bg-gradient-to-r from-green-400 to-green-600 rounded-2xl p-6 mb-6 text-white">
                        <div class="text-sm opacity-80 mb-1">Saldo Tersedia</div>
                        <div class="text-3xl font-bold mb-4">Rp 5.750.000</div>
                        <div class="flex justify-between text-sm">
                            <span>Pemasukan: +Rp 7.500.000</span>
                            <span>Pengeluaran: -Rp 1.750.000</span>
                        </div>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                </svg>
                                <span class="text-sm font-medium text-green-800">Pemasukan</span>
                            </div>
                            <div class="text-lg font-bold text-green-900">Rp 7.5M</div>
                        </div>
                        <div class="bg-red-50 rounded-xl p-4 border border-red-100">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                </svg>
                                <span class="text-sm font-medium text-red-800">Pengeluaran</span>
                            </div>
                            <div class="text-lg font-bold text-red-900">Rp 1.7M</div>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Target Pengeluaran Bulanan</span>
                            <span class="font-medium text-gray-900">65%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -top-6 -right-6 bg-white rounded-2xl shadow-lg p-4 animate-bounce">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="text-sm font-medium">Laporan Bulanan</span>
                    </div>
                </div>
                
                <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-lg p-4 animate-pulse">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                        </svg>
                        <span class="text-sm font-medium">Kontrol Target</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-8 lg:px-12 xl:px-16">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full border border-green-200 mb-6">
                    <span class="text-green-600 text-sm font-medium">✨ Fitur Unggulan</span>
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Semua yang Anda Butuhkan untuk
                    <span class="bg-gradient-to-r from-green-400 to-green-600 bg-clip-text text-transparent">Keuangan Sehat</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Aplikasi lengkap dengan fitur-fitur yang dirancang khusus untuk membantu Anda mengelola keuangan pribadi dengan mudah, praktis, dan terstruktur.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-2xl p-8 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Pencatatan Transaksi Real-Time</h3>
                    <p class="text-gray-600 leading-relaxed">Catat pemasukan dan pengeluaran secara praktis dan instan melalui antarmuka yang sederhana dan user-friendly.</p>
                    <div class="mt-4 flex items-center text-green-600 font-medium">
                        <span class="text-sm">Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-2xl p-8 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-700 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m5 0h2a2 2 0 002-2V7a2 2 0 00-2-2h-2m-5 0V3a2 2 0 012-2V1m0 2h2a2 2 0 012 2v2M9 3v2m3 2v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Kategori & Target Pengeluaran</h3>
                    <p class="text-gray-600 leading-relaxed">Kelompokkan transaksi berdasarkan kategori dan tetapkan target pengeluaran untuk kontrol keuangan yang lebih baik.</p>
                    <div class="mt-4 flex items-center text-green-600 font-medium">
                        <span class="text-sm">Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
                
                <div class="group bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-2xl p-8 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-green-800 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Laporan Keuangan Bulanan</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan laporan keuangan bulanan yang jelas dan informatif dengan grafik dan visualisasi data yang mudah dipahami.</p>
                    <div class="mt-4 flex items-center text-green-600 font-medium">
                        <span class="text-sm">Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section - Full Width -->
    <section class="py-24 bg-gradient-to-r from-green-400 via-green-500 to-green-600 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><circle fill="%23ffffff" cx="30" cy="30" r="2"/></g></svg>');"></div>
        </div>
        
        <!-- Floating shapes -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-white/10 rounded-full animate-float-delay"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full animate-float"></div>
        
        <div class="max-w-7xl mx-auto px-8 lg:px-12 xl:px-16 relative z-10">
            <div class="text-center text-white">
                <div class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full border border-white/30 mb-8">
                    <span class="text-white text-sm font-medium">🎯 Statistik Terkini</span>
                </div>
                
                <h2 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                    Dipercaya oleh Pengguna Aktif
                    <span class="block text-3xl lg:text-4xl text-green-100 font-medium mt-2">di Seluruh Indonesia</span>
                </h2>
                
                <p class="text-xl text-green-50 mb-16 max-w-2xl mx-auto leading-relaxed">
                    Bergabunglah dengan komunitas yang sudah merasakan manfaat pengelolaan keuangan pribadi yang lebih baik dan terstruktur
                </p>
                
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                    <div class="group text-center transform hover:scale-105 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 lg:p-8 border border-white/20 group-hover:bg-white/20 transition-all duration-300">
                            <div class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-b from-white to-green-100 bg-clip-text text-transparent">1,000+</div>
                            <div class="text-green-50 text-sm lg:text-base font-medium">Pengguna Aktif</div>
                            <div class="text-green-100 text-xs mt-1 opacity-80">Setiap bulan</div>
                        </div>
                    </div>
                    
                    <div class="group text-center transform hover:scale-105 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 lg:p-8 border border-white/20 group-hover:bg-white/20 transition-all duration-300">
                            <div class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-b from-white to-green-100 bg-clip-text text-transparent">50K+</div>
                            <div class="text-green-50 text-sm lg:text-base font-medium">Transaksi Tercatat</div>
                            <div class="text-green-100 text-xs mt-1 opacity-80">Dan terus bertambah</div>
                        </div>
                    </div>
                    
                    <div class="group text-center transform hover:scale-105 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 lg:p-8 border border-white/20 group-hover:bg-white/20 transition-all duration-300">
                            <div class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-b from-white to-green-100 bg-clip-text text-transparent">4.8/5</div>
                            <div class="text-green-50 text-sm lg:text-base font-medium">Rating Pengguna</div>
                            <div class="text-green-100 text-xs mt-1 opacity-80">Dari 500+ review</div>
                        </div>
                    </div>
                    
                    <div class="group text-center transform hover:scale-105 transition-all duration-300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 lg:p-8 border border-white/20 group-hover:bg-white/20 transition-all duration-300">
                            <div class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-b from-white to-green-100 bg-clip-text text-transparent">24/7</div>
                            <div class="text-green-50 text-sm lg:text-base font-medium">Dukungan Pengguna</div>
                            <div class="text-green-100 text-xs mt-1 opacity-80">Siap membantu Anda</div>
                        </div>
                    </div>
                </div>
                
                <!-- Trust indicators -->
                <div class="mt-16 flex flex-wrap justify-center items-center gap-8 opacity-80">
                    <div class="flex items-center space-x-2 text-green-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="text-sm font-medium">Data Aman</span>
                    </div>
                    <div class="flex items-center space-x-2 text-green-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="text-sm font-medium">Enkripsi Berlapis</span>
                    </div>
                    <div class="flex items-center space-x-2 text-green-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        <span class="text-sm font-medium">Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-black relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><circle fill="%23ffffff" cx="20" cy="20" r="1"/></g></svg>');"></div>
        </div>
        
        <!-- Floating elements -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-green-500/5 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-32 right-32 w-24 h-24 bg-blue-500/5 rounded-full blur-xl animate-pulse"></div>
        
        <div class="max-w-7xl mx-auto px-8 lg:px-12 xl:px-16 relative z-10">
            <!-- Main Footer Content -->
            <div class="pt-20 pb-12">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 lg:gap-16">
                    <!-- Brand Section -->
                    <div class="lg:col-span-1">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white">FinanceApp</h3>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Solusi terdepan untuk pengelolaan keuangan pribadi yang aman, mudah, dan terpercaya. Wujudkan impian finansial Anda bersama kami.
                        </p>
                        <!-- Social Media -->
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.742.099.12.112.225.085.402-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.748-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.017 0z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Product Links -->
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-6">Produk</h4>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Pencatatan Transaksi</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Budgeting Tools</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Laporan Keuangan</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Goal Setting</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Analisis Pengeluaran</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Mobile App</a></li>
                        </ul>
                    </div>
                    
                    <!-- Company Links -->
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-6">Perusahaan</h4>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Tentang Kami</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Karir</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Blog</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Press Kit</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Partnership</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Investor</a></li>
                        </ul>
                    </div>
                    
                    <!-- Support Links -->
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-6">Dukungan</h4>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Pusat Bantuan</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Kontak Support</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Tutorial</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">FAQ</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Status Server</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200">Feedback</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Newsletter Section -->
                <div class="mt-16 pt-12 border-t border-gray-700">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h4 class="text-2xl font-bold text-white mb-4">Dapatkan Tips Keuangan Terbaru</h4>
                            <p class="text-gray-300 leading-relaxed">
                                Berlangganan newsletter kami dan dapatkan tips, trik, dan insight terbaru tentang pengelolaan keuangan pribadi langsung di inbox Anda.
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <input type="email" placeholder="Masukkan email Anda" 
                                       class="w-full px-6 py-4 bg-gray-800 border border-gray-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <button class="px-8 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-green-500/25">
                                Berlangganan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <div class="py-8 border-t border-gray-700">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="text-gray-400 text-sm">
                        © 2024 FinanceApp. Seluruh hak cipta dilindungi undang-undang.
                    </div>
                    <div class="flex flex-wrap items-center space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-green-400 transition-colors duration-200">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition-colors duration-200">Syarat & Ketentuan</a>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition-colors duration-200">Keamanan</a>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition-colors duration-200">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        @keyframes float-delay {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-180deg); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-float-delay {
            animation: float-delay 8s ease-in-out infinite;
        }
    </style>
</body>
</html>