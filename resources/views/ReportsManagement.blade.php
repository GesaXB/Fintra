@extends('layouts.app')

@section('title', 'Budgets - Fintra')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F0FDF4] via-emerald-50 to-green-100 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-[#4ADE80]/20 to-emerald-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-green-200/30 to-[#4ADE80]/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-emerald-200/20 to-green-300/20 rounded-full blur-2xl animate-float"></div>
    </div>

    <!-- Header/Navbar -->
    <header class="relative bg-white/80 backdrop-blur-xl border-b border-[#4ADE80]/20 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center group cursor-pointer">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="relative w-12 h-12 bg-gradient-to-br from-[#4ADE80] to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                            <i class="fas fa-chart-line text-white text-xl"></i>
                            <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent rounded-2xl"></div>
                        </div>
                        <div class="ml-4">
                            <span class="text-3xl font-black bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 bg-clip-text text-transparent">Fintra</span>
                            <p class="text-xs text-gray-500 font-medium">Financial Tracker</p>
                        </div>
                    </a>
                </div>

                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-sm font-medium">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-[#4ADE80] transition-colors">Dashboard</a>
                    <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                    <span class="text-[#4ADE80] font-semibold">Categories</span>
                </nav>

                <!-- User Menu -->
                <div class="flex items-center space-x-6">
                    <!-- Notification Bell -->
                    <button class="relative p-3 rounded-xl bg-gradient-to-r from-[#F0FDF4] to-green-50 border border-[#4ADE80]/20 hover:from-[#4ADE80]/10 hover:to-emerald-100 transition-all duration-300 hover:scale-105 group">
                        <i class="fas fa-bell text-gray-600 group-hover:text-[#4ADE80] transition-colors"></i>
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-r from-red-400 to-red-500 text-white text-xs rounded-full flex items-center justify-center animate-bounce">3</span>
                    </button>

                    <div class="h-8 w-px bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>

                    <span class="text-gray-700 font-semibold text-lg" id="userName">
                        @auth
                            Hello, {{ Auth::user()->name }}
                        @else
                            Loading...
                        @endauth
                    </span>

                    <div class="relative">
                        <button type="button"
                                class="flex items-center space-x-3 p-2 rounded-2xl bg-gradient-to-r from-[#F0FDF4] to-green-50 border border-[#4ADE80]/20 hover:from-[#4ADE80]/10 hover:to-emerald-100 transition-all duration-300 hover:scale-105 group"
                                id="userMenuButton"
                                onclick="toggleUserMenu()">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#4ADE80] to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                                <i class="fas fa-user text-white text-lg"></i>
                                <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500 text-sm transform transition-transform duration-300 group-hover:text-[#4ADE80]" id="chevronIcon"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-4 w-64 bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-[#4ADE80]/20 py-3 z-50 hidden transform transition-all duration-300 origin-top-right scale-95 opacity-0"
                             id="userDropdown">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Signed in as</p>
                                <p class="font-semibold text-gray-800 truncate" id="dropdownUserName">User Name</p>
                            </div>
                            <a href="#"
                               class="flex items-center px-6 py-4 text-gray-700 hover:bg-gradient-to-r hover:from-[#4ADE80]/10 hover:to-emerald-100 hover:text-[#4ADE80] transition-all duration-300 group">
                                <i class="fas fa-user mr-4 w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Profile Settings</span>
                            </a>
                            <a href="#"
                               class="flex items-center px-6 py-4 text-gray-700 hover:bg-gradient-to-r hover:from-[#4ADE80]/10 hover:to-emerald-100 hover:text-[#4ADE80] transition-all duration-300 group">
                                <i class="fas fa-cog mr-4 w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Preferences</span>
                            </a>
                            <a href="#"
                               class="flex items-center px-6 py-4 text-gray-700 hover:bg-gradient-to-r hover:from-[#4ADE80]/10 hover:to-emerald-100 hover:text-[#4ADE80] transition-all duration-300 group">
                                <i class="fas fa-question-circle mr-4 w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Help & Support</span>
                            </a>
                            <hr class="my-3 border-gray-100">
                            <button type="button"
                                    class="w-full flex items-center px-6 py-4 text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 transition-all duration-300 group"
                                    onclick="logout()">
                                <i class="fas fa-sign-out-alt mr-4 w-5 text-center group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Sign Out</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Budgets</h1>
            <p class="text-gray-600">Manage your budgets and track your spending goals</p>
        </div>

        <!-- Budget Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Budget -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Budget</h3>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-2">Rp 8.500.000</div>
                <div class="text-sm text-emerald-600 font-medium">+12% from last month</div>
            </div>

            <!-- Used Budget -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Used Budget</h3>
                    <div class="w-10 h-10 bg-gradient-to-br from-red-400 to-red-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-800 mb-2">Rp 5.200.000</div>
                <div class="text-sm text-red-500 font-medium">61% of total budget</div>
            </div>

            <!-- Remaining Budget -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Remaining Budget</h3>
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-emerald-600 mb-2">Rp 3.300.000</div>
                <div class="text-sm text-emerald-600 font-medium">39% remaining</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 border border-white/20 mb-8 hover:shadow-xl transition-all duration-300">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
            <div class="flex flex-wrap gap-3">
                <button class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Create Budget</span>
                </button>
                <button class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit Budget</span>
                </button>
                <button class="bg-white/80 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-white transition-all duration-300 flex items-center space-x-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 border border-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>View Reports</span>
                </button>
            </div>
        </div>

        <!-- Budget Categories -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Budget List -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="p-6 border-b border-emerald-100/50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-800">Budget Categories</h3>
                        <button class="text-emerald-600 hover:text-emerald-700 font-medium text-sm bg-emerald-50 px-3 py-1 rounded-lg hover:bg-emerald-100 transition-colors">View All</button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <!-- Food & Dining -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Food & Dining</div>
                                    <div class="text-sm text-gray-500">Rp 1.200.000 / Rp 2.000.000</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-semibold text-gray-900">60%</div>
                                <div class="w-16 h-2 bg-gray-200 rounded-full mt-1">
                                    <div class="w-3/5 h-2 bg-emerald-500 rounded-full"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Transportation -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Transportation</div>
                                    <div class="text-sm text-gray-500">Rp 800.000 / Rp 1.500.000</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-semibold text-gray-900">53%</div>
                                <div class="w-16 h-2 bg-gray-200 rounded-full mt-1">
                                    <div class="w-1/2 h-2 bg-blue-500 rounded-full"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Shopping -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Shopping</div>
                                    <div class="text-sm text-gray-500">Rp 1.500.000 / Rp 2.500.000</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-semibold text-gray-900">60%</div>
                                <div class="w-16 h-2 bg-gray-200 rounded-full mt-1">
                                    <div class="w-3/5 h-2 bg-yellow-500 rounded-full"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Entertainment -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M9 10v4a2 2 0 002 2h2a2 2 0 002-2v-4M9 10V8a2 2 0 012-2h2a2 2 0 012 2v2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Entertainment</div>
                                    <div class="text-sm text-gray-500">Rp 600.000 / Rp 1.000.000</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-semibold text-gray-900">60%</div>
                                <div class="w-16 h-2 bg-gray-200 rounded-full mt-1">
                                    <div class="w-3/5 h-2 bg-purple-500 rounded-full"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Bills -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Bills</div>
                                    <div class="text-sm text-gray-500">Rp 1.100.000 / Rp 1.500.000</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-semibold text-gray-900">73%</div>
                                <div class="w-16 h-2 bg-gray-200 rounded-full mt-1">
                                    <div class="w-3/4 h-2 bg-red-500 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Budget Overview Chart -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="p-6 border-b border-emerald-100/50">
                    <h3 class="text-lg font-bold text-gray-800">Budget Overview</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-center h-64">
                        <div class="relative w-48 h-48">
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 42 42">
                                <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="#e5e7eb" stroke-width="3"/>
                                <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="#10b981" stroke-width="3" stroke-dasharray="61 39" stroke-dashoffset="0"/>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">61%</div>
                                    <div class="text-sm text-gray-500">Used</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Used Budget</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Rp 5.200.000</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                <span class="text-sm text-gray-600">Remaining Budget</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Rp 3.300.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Budget Activities -->
        <div class="mt-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="p-6 border-b border-emerald-100/50">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800">Recent Budget Activities</h3>
                    <button class="text-emerald-600 hover:text-emerald-700 font-medium text-sm bg-emerald-50 px-3 py-1 rounded-lg hover:bg-emerald-100 transition-colors">View All</button>
                </div>
            </div>
            <div class="p-6">
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-inner">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">No recent activities</h4>
                    <p class="text-gray-600 mb-6">Start managing your budgets to see activities here</p>
                    <button class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-8 py-3 rounded-xl font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Create Your First Budget
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Enhanced emerald theme colors */
    .bg-emerald-500 { background-color: #10b981; }
    .bg-emerald-600 { background-color: #059669; }
    .text-emerald-500 { color: #10b981; }
    .text-emerald-600 { color: #059669; }
    .text-emerald-700 { color: #047857; }
    .bg-emerald-100 { background-color: #d1fae5; }
    .bg-emerald-50 { background-color: #ecfdf5; }
    .border-emerald-100 { border-color: #a7f3d0; }
    .border-emerald-200 { border-color: #a7f3d0; }

    /* Custom gradients and glass effects */
    .glass-card {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    /* Smooth transitions for all interactive elements */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #10b981, #059669);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #059669, #047857);
    }
</style>
@endpush
