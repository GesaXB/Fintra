@extends('layouts.app')

@section('title', 'Dashboard - Fintra')

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
                    <div class="relative w-12 h-12 bg-gradient-to-br from-[#4ADE80] to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent rounded-2xl"></div>
                    </div>
                    <div class="ml-4">
                        <span class="text-3xl font-black bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 bg-clip-text text-transparent">Fintra</span>
                        <p class="text-xs text-gray-500 font-medium">Financial Tracker</p>
                    </div>
                </div>

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
    <main class="relative max-w-7xl mx-auto py-12 px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="mb-16 text-center animate-fade-in">
            <h1 class="text-6xl font-black bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 bg-clip-text text-transparent mb-4 tracking-tight">
                Financial Dashboard
            </h1>
            <p class="text-xl text-gray-600 font-medium max-w-2xl mx-auto leading-relaxed">
                Take complete control of your financial journey with intelligent insights and beautiful analytics
            </p>
            <div class="flex justify-center mt-8">
                <div class="h-1 w-24 bg-gradient-to-r from-[#4ADE80] to-emerald-500 rounded-full"></div>
            </div>
        </div>

        <!-- Financial Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-16">
            <!-- Total Balance -->
            <div class="group relative bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up overflow-hidden" style="animation-delay: 0.1s">
                <div class="absolute inset-0 bg-gradient-to-br from-[#4ADE80]/5 to-emerald-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Total Balance</p>
                        <p class="text-4xl font-black text-gray-800 mb-2" id="totalBalance">Rp 0</p>
                        <div class="flex items-center text-sm">
                            <span class="text-green-600 font-semibold">+12.5%</span>
                            <span class="text-gray-500 ml-2">from last month</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-[#4ADE80] to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 relative overflow-hidden">
                        <i class="fas fa-wallet text-white text-2xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-[#4ADE80] to-emerald-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>

            <!-- Monthly Income -->
            <div class="group relative bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up overflow-hidden" style="animation-delay: 0.2s">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-[#4ADE80]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Monthly Income</p>
                        <p class="text-4xl font-black text-green-600 mb-2" id="monthlyIncome">Rp 0</p>
                        <div class="flex items-center text-sm">
                            <span class="text-green-600 font-semibold">+8.2%</span>
                            <span class="text-gray-500 ml-2">vs last month</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 relative overflow-hidden">
                        <i class="fas fa-arrow-trend-up text-white text-2xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-green-400 to-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>

            <!-- Monthly Expense -->
            <div class="group relative bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up overflow-hidden" style="animation-delay: 0.3s">
                <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-orange-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Monthly Expense</p>
                        <p class="text-4xl font-black text-red-500 mb-2" id="monthlyExpense">Rp 0</p>
                        <div class="flex items-center text-sm">
                            <span class="text-red-500 font-semibold">-3.1%</span>
                            <span class="text-gray-500 ml-2">from last month</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 relative overflow-hidden">
                        <i class="fas fa-arrow-trend-down text-white text-2xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-red-400 to-red-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>

            <!-- Budget Status -->
            <div class="group relative bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up overflow-hidden" style="animation-delay: 0.4s">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-yellow-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Budget Used</p>
                        <p class="text-4xl font-black text-orange-500 mb-2" id="budgetStatus">0%</p>
                        <div class="flex items-center text-sm">
                            <span class="text-orange-500 font-semibold">65% used</span>
                            <span class="text-gray-500 ml-2">this month</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 relative overflow-hidden">
                        <i class="fas fa-chart-pie text-white text-2xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-orange-400 to-orange-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>
        </div>

        <!-- Charts and Reports Section -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-16">
            <!-- Financial Overview Chart -->
            <div class="xl:col-span-2 bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 animate-slide-up" style="animation-delay: 0.5s">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Financial Overview</h3>
                        <p class="text-gray-600">Track your income and expenses over time</p>
                    </div>
                    <div class="flex space-x-2 bg-[#F0FDF4] p-2 rounded-2xl border border-[#4ADE80]/20">
                        <button class="px-4 py-2 text-sm font-semibold bg-gradient-to-r from-[#4ADE80] to-emerald-500 text-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl active-period">7D</button>
                        <button class="px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl hover:bg-white/50 transition-all duration-300 period-btn" data-period="30">30D</button>
                        <button class="px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl hover:bg-white/50 transition-all duration-300 period-btn" data-period="90">90D</button>
                    </div>
                </div>
                <div class="h-80 relative">
                    <canvas id="financialChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Quick Actions & Mini Reports -->
            <div class="space-y-8">
                <!-- Quick Actions -->
                <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 animate-slide-up" style="animation-delay: 0.6s">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Quick Actions</h3>
                    <div class="space-y-4">
                        <button class="w-full group bg-gradient-to-r from-[#4ADE80] to-emerald-500 hover:from-emerald-500 hover:to-[#4ADE80] text-white px-6 py-5 rounded-2xl flex items-center justify-center shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 transform relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <i class="fas fa-plus mr-3 text-xl group-hover:rotate-90 transition-transform duration-300"></i>
                            <span class="font-bold text-lg">Add Income</span>
                        </button>
                        <button class="w-full group bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white px-6 py-5 rounded-2xl flex items-center justify-center shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 transform relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <i class="fas fa-minus mr-3 text-xl group-hover:rotate-90 transition-transform duration-300"></i>
                            <span class="font-bold text-lg">Add Expense</span>
                        </button>
                    </div>
                </div>

                <!-- Category Breakdown -->
                <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 animate-slide-up" style="animation-delay: 0.7s">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Expense Categories</h3>
                    <div class="h-48 relative">
                        <canvas id="categoryChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <a href={{ route('transaction') }} class="group bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up relative overflow-hidden" style="animation-delay: 0.8s">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <i class="fas fa-list text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-blue-600 transition-colors">Transactions</h4>
                    <p class="text-gray-600 text-sm">View all transactions</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </a>

            <a href="{{ route('budgets') }}" class="group bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up relative overflow-hidden" style="animation-delay: 0.9s">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-purple-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <i class="fas fa-chart-bar text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-purple-600 transition-colors">Budgets</h4>
                    <p class="text-gray-600 text-sm">Manage your budgets</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-400 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </a>

            <a href="{{ route('categories') }}" class="group bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up relative overflow-hidden" style="animation-delay: 1.0s">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-orange-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <i class="fas fa-tags text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-orange-600 transition-colors">Categories</h4>
                    <p class="text-gray-600 text-sm">Organize categories</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-400 to-orange-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </a>

            <a href="{{ route('reports') }}" class="group bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up relative overflow-hidden" style="animation-delay: 1.1s">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-500/5 to-teal-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-teal-600 transition-colors">Reports</h4>
                    <p class="text-gray-600 text-sm">Financial insights</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-teal-400 to-teal-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </a>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 animate-slide-up overflow-hidden" style="animation-delay: 1.2s">
            <div class="px-8 py-6 border-b border-[#4ADE80]/20 bg-gradient-to-r from-[#F0FDF4] to-green-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Recent Transactions</h3>
                        <p class="text-gray-600 mt-1">Your latest financial activities</p>
                    </div>
                    <a href="#" class="px-6 py-3 bg-gradient-to-r from-[#4ADE80] to-emerald-500 hover:from-emerald-500 hover:to-[#4ADE80] text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        View All
                    </a>
                </div>
            </div>
            <div class="p-8">
                <div id="recentTransactions" class="space-y-6">
                    <!-- Placeholder for recent transactions -->
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gradient-to-br from-[#4ADE80]/20 to-emerald-200/30 rounded-3xl flex items-center justify-center mx-auto mb-6 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                            <i class="fas fa-receipt text-[#4ADE80] text-3xl animate-bounce"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-3">No transactions yet</h4>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">Start your financial journey by adding your first income or expense transaction</p>
                        <button class="px-8 py-4 bg-gradient-to-r from-[#4ADE80] to-emerald-500 hover:from-emerald-500 hover:to-[#4ADE80] text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            Add Transaction
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white/95 backdrop-blur-xl p-10 rounded-3xl shadow-2xl text-center border border-[#4ADE80]/20 max-w-sm mx-4">
        <div class="w-16 h-16 bg-gradient-to-br from-[#4ADE80] to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6 animate-spin">
            <i class="fas fa-spinner text-white text-xl"></i>
        </div>
        <p class="text-gray-700 font-semibold text-lg">Signing out...</p>
        <p class="text-gray-500 text-sm mt-2">Please wait a moment</p>
    </div>
</div>

<!-- Hidden logout form for web logout -->
<form id="webLogoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
// Chart instances
let financialChart = null;
let categoryChart = null;

// Check if user is using token-based authentication
function isTokenAuth() {
    return localStorage.getItem('auth_token') !== null;
}

// Toggle user dropdown menu with enhanced animation
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    const chevron = document.getElementById('chevronIcon');

    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        // Force reflow
        dropdown.offsetHeight;
        dropdown.classList.remove('scale-95', 'opacity-0');
        dropdown.classList.add('scale-100', 'opacity-100');
        chevron.classList.add('rotate-180');
    } else {
        dropdown.classList.add('scale-95', 'opacity-0');
        dropdown.classList.remove('scale-100', 'opacity-100');
        chevron.classList.remove('rotate-180');
        setTimeout(() => {
            dropdown.classList.add('hidden');
        }, 200);
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdown = document.getElementById('userDropdown');
    const chevron = document.getElementById('chevronIcon');

    if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
        userDropdown.classList.add('scale-95', 'opacity-0');
        userDropdown.classList.remove('scale-100', 'opacity-100');
        chevron.classList.remove('rotate-180');
        setTimeout(() => {
            userDropdown.classList.add('hidden');
        }, 200);
    }
});

// Format currency to Indonesian Rupiah
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Initialize financial overview chart
function initFinancialChart() {
    const ctx = document.getElementById('financialChart').getContext('2d');

    const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient1.addColorStop(0, 'rgba(74, 222, 128, 0.8)');
    gradient1.addColorStop(1, 'rgba(74, 222, 128, 0.1)');

    const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient2.addColorStop(0, 'rgba(239, 68, 68, 0.8)');
    gradient2.addColorStop(1, 'rgba(239, 68, 68, 0.1)');

    financialChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Income',
                data: [1200000, 1900000, 800000, 1500000, 2000000, 1800000, 2200000],
                borderColor: '#4ADE80',
                backgroundColor: gradient1,
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4ADE80',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 8,
                pointHoverRadius: 12,
                pointHoverBackgroundColor: '#4ADE80',
                pointHoverBorderColor: '#ffffff',
                pointHoverBorderWidth: 4
            }, {
                label: 'Expense',
                data: [800000, 1200000, 600000, 900000, 1100000, 1000000, 1300000],
                borderColor: '#ef4444',
                backgroundColor: gradient2,
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ef4444',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 8,
                pointHoverRadius: 12,
                pointHoverBackgroundColor: '#ef4444',
                pointHoverBorderColor: '#ffffff',
                pointHoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 25,
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#374151'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#374151',
                    bodyColor: '#374151',
                    borderColor: '#4ADE80',
                    borderWidth: 2,
                    cornerRadius: 12,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + formatCurrency(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(74, 222, 128, 0.1)',
                        lineWidth: 1
                    },
                    border: {
                        display: false
                    },
                    ticks: {
                        color: '#6B7280',
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                        },
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    border: {
                        display: false
                    },
                    ticks: {
                        color: '#6B7280',
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        padding: 10
                    }
                }
            }
        }
    });
}

// Initialize category chart (donut chart)
function initCategoryChart() {
    const ctx = document.getElementById('categoryChart').getContext('2d');

    categoryChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Food & Dining', 'Transportation', 'Shopping', 'Entertainment', 'Bills', 'Others'],
            datasets: [{
                data: [35, 20, 15, 10, 15, 5],
                backgroundColor: [
                    '#4ADE80',
                    '#3B82F6',
                    '#F59E0B',
                    '#EF4444',
                    '#8B5CF6',
                    '#6B7280'
                ],
                borderWidth: 0,
                hoverBorderWidth: 4,
                hoverBorderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 11,
                            weight: '500'
                        },
                        color: '#374151'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#374151',
                    bodyColor: '#374151',
                    borderColor: '#4ADE80',
                    borderWidth: 2,
                    cornerRadius: 12,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            }
        }
    });
}

// Load dashboard data with enhanced animations
async function loadDashboardData() {
    try {
        // Mock data for demonstration
        const dashboardData = {
            totalBalance: 5000000,
            monthlyIncome: 3000000,
            monthlyExpense: 1500000,
            budgetUsage: 65
        };

        // Animate numbers counting up with staggered timing
        setTimeout(() => animateValue('totalBalance', 0, dashboardData.totalBalance, 2500, formatCurrency), 200);
        setTimeout(() => animateValue('monthlyIncome', 0, dashboardData.monthlyIncome, 2500, formatCurrency), 400);
        setTimeout(() => animateValue('monthlyExpense', 0, dashboardData.monthlyExpense, 2500, formatCurrency), 600);
        setTimeout(() => animateValue('budgetStatus', 0, dashboardData.budgetUsage, 2500, (val) => val + '%'), 800);

    } catch (error) {
        console.error('Error loading dashboard data:', error);
    }
}

// Enhanced number animation with easing
function animateValue(elementId, start, end, duration, formatter) {
    const element = document.getElementById(elementId);
    const startTime = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Enhanced easing function (ease-out-quart)
        const easeOut = 1 - Math.pow(1 - progress, 4);
        const current = start + (end - start) * easeOut;

        element.textContent = formatter(Math.floor(current));

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = formatter(end);
        }
    }

    requestAnimationFrame(update);
}

// Load user data for token-based auth
async function loadUserData() {
    if (!isTokenAuth()) {
        return;
    }

    const token = localStorage.getItem('auth_token');

    if (!token) {
        window.location.href = '/login';
        return;
    }

    try {
        const response = await fetch('/api/user', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (response.status === 401) {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
            return;
        }

        if (response.ok) {
            const data = await response.json();
            const userName = `Hello, ${data.user.name}`;
            document.getElementById('userName').textContent = userName;
            document.getElementById('dropdownUserName').textContent = data.user.name;
            localStorage.setItem('user', JSON.stringify(data.user));
        }
    } catch (error) {
        console.error('Error loading user data:', error);
    }
}

// API logout function for token-based auth
async function logoutWithToken() {
    const token = localStorage.getItem('auth_token');

    if (!token) {
        return false;
    }

    try {
        const response = await fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();
        console.log('API Logout response:', data);

        return response.ok;
    } catch (error) {
        console.error('API Logout error:', error);
        return false;
    }
}

// Web logout function for session-based auth
function logoutWithSession() {
    document.getElementById('webLogoutForm').submit();
}

// Enhanced logout function with better UX
async function logout() {
    const loadingOverlay = document.getElementById('loadingOverlay');

    try {
        loadingOverlay.classList.remove('hidden');

        // Add slight delay for better UX
        await new Promise(resolve => setTimeout(resolve, 800));

        if (isTokenAuth()) {
            await logoutWithToken();
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            sessionStorage.clear();
            window.location.href = '/login';
        } else {
            logoutWithSession();
        }

    } catch (error) {
        console.error('Logout error:', error);

        if (isTokenAuth()) {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            sessionStorage.clear();
            window.location.href = '/login';
        }
    } finally {
        loadingOverlay.classList.add('hidden');
    }
}

// Chart period buttons functionality
function initPeriodButtons() {
    const periodButtons = document.querySelectorAll('.period-btn');

    periodButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelector('.active-period').classList.remove('active-period');
            document.querySelector('.active-period').classList.add('text-gray-600', 'hover:bg-white/50');
            document.querySelector('.active-period').classList.remove('bg-gradient-to-r', 'from-[#4ADE80]', 'to-emerald-500', 'text-white', 'shadow-lg');

            // Add active class to clicked button
            this.classList.add('active-period');
            this.classList.remove('text-gray-600', 'hover:bg-white/50');
            this.classList.add('bg-gradient-to-r', 'from-[#4ADE80]', 'to-emerald-500', 'text-white', 'shadow-lg');

            // Update chart data based on period
            const period = this.dataset.period || '7';
            updateChartData(period);
        });
    });
}

// Update chart data based on selected period
function updateChartData(period) {
    if (!financialChart) return;

    let newData, newLabels;

    switch(period) {
        case '30':
            newLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            newData = {
                income: [8500000, 9200000, 7800000, 10500000],
                expense: [4200000, 5100000, 3900000, 5800000]
            };
            break;
        case '90':
            newLabels = ['Month 1', 'Month 2', 'Month 3'];
            newData = {
                income: [25000000, 28000000, 32000000],
                expense: [15000000, 18000000, 21000000]
            };
            break;
        default: // 7 days
            newLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            newData = {
                income: [1200000, 1900000, 800000, 1500000, 2000000, 1800000, 2200000],
                expense: [800000, 1200000, 600000, 900000, 1100000, 1000000, 1300000]
            };
    }

    financialChart.data.labels = newLabels;
    financialChart.data.datasets[0].data = newData.income;
    financialChart.data.datasets[1].data = newData.expense;
    financialChart.update('active');
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    if (isTokenAuth()) {
        loadUserData();
    }

    loadDashboardData();
    initFinancialChart();
    initCategoryChart();
    initPeriodButtons();
});

// Handle window resize for responsive charts
window.addEventListener('resize', function() {
    if (financialChart) financialChart.resize();
    if (categoryChart) categoryChart.resize();
});
</script>

<style>
/* Enhanced animations and custom styles */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(40px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.8s ease-out both;
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

/* Custom scrollbar with gradient */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #F0FDF4, #ECFDF5);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #4ADE80, #22C55E);
    border-radius: 10px;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #22C55E, #16A34A);
}

/* Smooth transitions for all interactive elements */
* {
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Enhanced button hover effects */
button:hover, a:hover {
    transform: translateY(-1px);
}

button:active, a:active {
    transform: translateY(0);
}

/* Glass morphism effect enhancement */
.backdrop-blur-xl {
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
}

/* Chart container improvements */
canvas {
    border-radius: 16px;
}

/* Loading animation enhancement */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Period button active state */
.active-period {
    background: linear-gradient(to right, #4ADE80, #10B981) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(74, 222, 128, 0.4) !important;
}

/* Notification badge pulse */
@keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
        transform: translate3d(0,0,0);
    }
    40%, 43% {
        transform: translate3d(0, -8px, 0);
    }
    70% {
        transform: translate3d(0, -4px, 0);
    }
    90% {
        transform: translate3d(0, -2px, 0);
    }
}

.animate-bounce {
    animation: bounce 1s infinite;
}

/* Responsive design improvements */
@media (max-width: 768px) {
    .text-6xl {
        font-size: 3rem;
    }

    .text-4xl {
        font-size: 2rem;
    }

    .p-8 {
        padding: 1.5rem;
    }

    .py-12 {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
}

/* Enhanced focus states for accessibility */
button:focus-visible, a:focus-visible {
    outline: 2px solid #4ADE80;
    outline-offset: 2px;
}

/* Improved card hover states */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1) rotate(3deg);
}

.group:hover .group-hover\:rotate-3 {
    transform: rotate(3deg);
}
</style>

@endpush
