@extends('layouts.app')

@section('title', 'Categories - Fintra')

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
    <main class="relative max-w-7xl mx-auto py-12 px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-16 text-center animate-fade-in">
            <h1 class="text-6xl font-black bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 bg-clip-text text-transparent mb-4 tracking-tight">
                Manage Categories
            </h1>
            <p class="text-xl text-gray-600 font-medium max-w-2xl mx-auto leading-relaxed">
                Organize your income and expense categories to better track your financial activities
            </p>
            <div class="flex justify-center mt-8">
                <div class="h-1 w-24 bg-gradient-to-r from-[#4ADE80] to-emerald-500 rounded-full"></div>
            </div>
        </div>

        <!-- Category Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Total Categories -->
            <div class="group relative bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up overflow-hidden" style="animation-delay: 0.1s">
                <div class="absolute inset-0 bg-gradient-to-br from-[#4ADE80]/5 to-emerald-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Total Categories</p>
                        <p class="text-4xl font-black text-gray-800 mb-2" id="totalCategories">0</p>
                        <div class="flex items-center text-sm">
                            <span class="text-gray-500">All categories</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-[#4ADE80] to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 relative overflow-hidden">
                        <i class="fas fa-tags text-white text-2xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-[#4ADE80] to-emerald-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>

            <!-- Income Categories -->
            <div class="group relative bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up overflow-hidden" style="animation-delay: 0.2s">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-[#4ADE80]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Income Categories</p>
                        <p class="text-4xl font-black text-green-600 mb-2" id="incomeCategories">0</p>
                        <div class="flex items-center text-sm">
                            <span class="text-gray-500">Income types</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 relative overflow-hidden">
                        <i class="fas fa-arrow-trend-up text-white text-2xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-green-400 to-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>

            <!-- Expense Categories -->
            <div class="group relative bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-slide-up overflow-hidden" style="animation-delay: 0.3s">
                <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-orange-200/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Expense Categories</p>
                        <p class="text-4xl font-black text-red-500 mb-2" id="expenseCategories">0</p>
                        <div class="flex items-center text-sm">
                            <span class="text-gray-500">Expense types</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 relative overflow-hidden">
                        <i class="fas fa-arrow-trend-down text-white text-2xl"></i>
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-red-400 to-red-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-16">
            <!-- Add Category Form -->
            <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 p-8 animate-slide-up" style="animation-delay: 0.4s">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Add New Category</h3>
                        <p class="text-gray-600">Create a new income or expense category</p>
                    </div>
                </div>

                <form id="categoryForm" class="space-y-6">
                    <!-- Category Name Input -->
                    <div class="relative">
                        <label for="categoryName" class="block text-sm font-bold text-gray-700 mb-3">Category Name</label>
                        <div class="relative">
                            <input type="text" 
                                   id="categoryName" 
                                   name="name"
                                   class="w-full px-6 py-4 bg-gradient-to-r from-[#F0FDF4] to-green-50 border border-[#4ADE80]/20 rounded-2xl focus:ring-4 focus:ring-[#4ADE80]/20 focus:border-[#4ADE80] transition-all duration-300 text-gray-800 font-medium placeholder-gray-500"
                                   placeholder="Enter category name..."
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                                <i class="fas fa-tag text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Category Type Selection -->
                    <div class="relative">
                        <label class="block text-sm font-bold text-gray-700 mb-3">Category Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="income" class="sr-only peer" required>
                                <div class="p-6 bg-gradient-to-r from-[#F0FDF4] to-green-50 border-2 border-[#4ADE80]/20 rounded-2xl transition-all duration-300 peer-checked:border-green-500 peer-checked:bg-gradient-to-r peer-checked:from-green-50 peer-checked:to-green-100 hover:scale-105 group">
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-arrow-trend-up text-white text-lg"></i>
                                        </div>
                                        <span class="font-semibold text-gray-800">Income</span>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="expense" class="sr-only peer" required>
                                <div class="p-6 bg-gradient-to-r from-[#F0FDF4] to-green-50 border-2 border-[#4ADE80]/20 rounded-2xl transition-all duration-300 peer-checked:border-red-500 peer-checked:bg-gradient-to-r peer-checked:from-red-50 peer-checked:to-red-100 hover:scale-105 group">
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-arrow-trend-down text-white text-lg"></i>
                                        </div>
                                        <span class="font-semibold text-gray-800">Expense</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full group bg-gradient-to-r from-[#4ADE80] to-emerald-500 hover:from-emerald-500 hover:to-[#4ADE80] text-white px-8 py-4 rounded-2xl flex items-center justify-center shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 transform relative overflow-hidden font-bold text-lg"
                            id="submitBtn">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <i class="fas fa-plus mr-3 text-xl group-hover:rotate-90 transition-transform duration-300"></i>
                        <span id="submitBtnText">Add Category</span>
                    </button>
                </form>
            </div>

            <!-- Categories List -->
            <div class="xl:col-span-2 bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-[#4ADE80]/20 animate-slide-up overflow-hidden" style="animation-delay: 0.5s">
                <div class="px-8 py-6 border-b border-[#4ADE80]/20 bg-gradient-to-r from-[#F0FDF4] to-green-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Your Categories</h3>
                            <p class="text-gray-600 mt-1">Manage all your income and expense categories</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <!-- Filter Buttons -->
                            <div class="flex space-x-2 bg-white/50 p-2 rounded-2xl border border-[#4ADE80]/20">
                                <button class="px-4 py-2 text-sm font-semibold bg-gradient-to-r from-[#4ADE80] to-emerald-500 text-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl filter-btn active" data-filter="all">All</button>
                                <button class="px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl hover:bg-white/50 transition-all duration-300 filter-btn" data-filter="income">Income</button>
                                <button class="px-4 py-2 text-sm font-semibold text-gray-600 rounded-xl hover:bg-white/50 transition-all duration-300 filter-btn" data-filter="expense">Expense</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- Loading State -->
                    <div id="categoriesLoading" class="text-center py-16 hidden">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#4ADE80] to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6 animate-spin">
                            <i class="fas fa-spinner text-white text-xl"></i>
                        </div>
                        <p class="text-gray-600 font-medium">Loading categories...</p>
                    </div>

                    <!-- Categories List Container -->
                    <div id="categoriesList" class="space-y-4">
                        <!-- Categories will be populated here -->
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="text-center py-16 hidden">
                        <div class="w-24 h-24 bg-gradient-to-br from-[#4ADE80]/20 to-emerald-200/30 rounded-3xl flex items-center justify-center mx-auto mb-6 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                            <i class="fas fa-tags text-[#4ADE80] text-3xl animate-bounce"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-3">No categories found</h4>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">Start organizing your finances by creating your first category</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Edit Category Modal -->
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white/95 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-[#4ADE80]/20 max-w-md w-full mx-4 animate-slide-up">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Edit Category</h3>
            <button onclick="closeEditModal()" class="p-2 hover:bg-gray-100 rounded-xl transition-colors">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <form id="editCategoryForm" class="space-y-6">
            <input type="hidden" id="editCategoryId">
            
            <!-- Category Name Input -->
            <div class="relative">
                <label for="editCategoryName" class="block text-sm font-bold text-gray-700 mb-3">Category Name</label>
                <div class="relative">
                    <input type="text" 
                           id="editCategoryName" 
                           name="name"
                           class="w-full px-6 py-4 bg-gradient-to-r from-[#F0FDF4] to-green-50 border border-[#4ADE80]/20 rounded-2xl focus:ring-4 focus:ring-[#4ADE80]/20 focus:border-[#4ADE80] transition-all duration-300 text-gray-800 font-medium placeholder-gray-500"
                           placeholder="Enter category name..."
                           required>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                        <i class="fas fa-tag text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Category Type Selection -->
            <div class="relative">
                <label class="block text-sm font-bold text-gray-700 mb-3">Category Type</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="editType" value="income" class="sr-only peer" required>
                        <div class="p-4 bg-gradient-to-r from-[#F0FDF4] to-green-50 border-2 border-[#4ADE80]/20 rounded-2xl transition-all duration-300 peer-checked:border-green-500 peer-checked:bg-gradient-to-r peer-checked:from-green-50 peer-checked:to-green-100 hover:scale-105 group">
                            <div class="text-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-arrow-trend-up text-white text-sm"></i>
                                </div>
                                <span class="font-semibold text-gray-800 text-sm">Income</span>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="editType" value="expense" class="sr-only peer" required>
                        <div class="p-4 bg-gradient-to-r from-[#F0FDF4] to-green-50 border-2 border-[#4ADE80]/20 rounded-2xl transition-all duration-300 peer-checked:border-red-500 peer-checked:bg-gradient-to-r peer-checked:from-red-50 peer-checked:to-red-100 hover:scale-105 group">
                            <div class="text-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-arrow-trend-down text-white text-sm"></i>
                                </div>
                                <span class="font-semibold text-gray-800 text-sm">Expense</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4">
                <button type="button" 
                        onclick="closeEditModal()"
                        class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-2xl transition-all duration-300">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#4ADE80] to-emerald-500 hover:from-emerald-500 hover:to-[#4ADE80] text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white/95 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-[#4ADE80]/20 max-w-md w-full mx-4 animate-slide-up">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Delete Category</h3>
            <button onclick="closeDeleteModal()" class="p-2 hover:bg-gray-100 rounded-xl transition-colors">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <div class="space-y-6">
            <p class="text-gray-600">Are you sure you want to delete this category? This action cannot be undone.</p>
            <p class="font-semibold text-gray-800" id="deleteCategoryName"></p>
            
            <div class="flex space-x-4">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-2xl transition-all duration-300">
                    Cancel
                </button>
                <button type="button" 
                        onclick="confirmDelete()"
                        class="flex-1 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-500 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105">
                    Delete Category
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Notification Toast -->
<div id="successToast" class="fixed top-6 right-6 bg-gradient-to-r from-[#4ADE80] to-emerald-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center space-x-4 transform translate-x-full transition-transform duration-300 z-50">
    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
        <i class="fas fa-check"></i>
    </div>
    <div>
        <p class="font-semibold" id="toastTitle">Success!</p>
        <p class="text-sm" id="toastMessage">Operation completed successfully</p>
    </div>
    <button onclick="hideToast()" class="p-1 hover:bg-white/20 rounded-full">
        <i class="fas fa-times"></i>
    </button>
</div>

<!-- Error Notification Toast -->
<div id="errorToast" class="fixed top-6 right-6 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center space-x-4 transform translate-x-full transition-transform duration-300 z-50">
    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
        <i class="fas fa-exclamation"></i>
    </div>
    <div>
        <p class="font-semibold" id="errorToastTitle">Error!</p>
        <p class="text-sm" id="errorToastMessage">Something went wrong</p>
    </div>
    <button onclick="hideErrorToast()" class="p-1 hover:bg-white/20 rounded-full">
        <i class="fas fa-times"></i>
    </button>
</div>

<!-- JavaScript -->
<script>
    // User Menu Toggle
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        const chevron = document.getElementById('chevronIcon');
        
        dropdown.classList.toggle('hidden');
        dropdown.classList.toggle('scale-95');
        dropdown.classList.toggle('opacity-0');
        dropdown.classList.toggle('scale-100');
        dropdown.classList.toggle('opacity-100');
        
        chevron.classList.toggle('rotate-180');
    }

    // Logout Function
    function logout() {
        // Clear token from localStorage
        localStorage.removeItem('token');
        // Redirect to login or use Laravel route
        window.location.href = "/login";
    }

    // Toast Functions
    function showToast(title, message) {
        const toast = document.getElementById('successToast');
        const toastTitle = document.getElementById('toastTitle');
        const toastMessage = document.getElementById('toastMessage');
        
        if (toast && toastTitle && toastMessage) {
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
            
            setTimeout(hideToast, 5000);
        }
    }

    function hideToast() {
        const toast = document.getElementById('successToast');
        if (toast) {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-full');
        }
    }

    function showErrorToast(title, message) {
        const toast = document.getElementById('errorToast');
        const toastTitle = document.getElementById('errorToastTitle');
        const toastMessage = document.getElementById('errorToastMessage');
        
        if (toast && toastTitle && toastMessage) {
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
            
            setTimeout(hideErrorToast, 5000);
        }
    }

    function hideErrorToast() {
        const toast = document.getElementById('errorToast');
        if (toast) {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-full');
        }
    }

    // Get CSRF Token
    function getCSRFToken() {
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        return csrfMeta ? csrfMeta.getAttribute('content') : '';
    }

    // Get Auth Token
    function getAuthToken() {
        // Try to get from localStorage first, then from meta tag, then from cookie
        let token = localStorage.getItem('token');
        
        if (!token) {
            const tokenMeta = document.querySelector('meta[name="auth-token"]');
            token = tokenMeta ? tokenMeta.getAttribute('content') : null;
        }
        
        return token;
    }

    // API Request Helper
    async function makeAPIRequest(url, options = {}) {
        const token = getAuthToken();
        const csrfToken = getCSRFToken();
        
        const defaultHeaders = {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        };

        // Add CSRF token for state-changing requests
        if (['POST', 'PUT', 'PATCH', 'DELETE'].includes(options.method?.toUpperCase())) {
            defaultHeaders['X-CSRF-TOKEN'] = csrfToken;
        }

        // Add auth token if available
        if (token) {
            defaultHeaders['Authorization'] = `Bearer ${token}`;
        }

        const config = {
            ...options,
            headers: {
                ...defaultHeaders,
                ...options.headers
            }
        };

        try {
            const response = await fetch(url, config);
            
            // Handle authentication errors
            if (response.status === 401) {
                localStorage.removeItem('token');
                window.location.href = '/login';
                return;
            }

            // Parse response
            const contentType = response.headers.get('content-type');
            let data;
            
            if (contentType && contentType.includes('application/json')) {
                data = await response.json();
            } else {
                data = await response.text();
            }

            if (!response.ok) {
                throw new Error(data.message || data || `HTTP ${response.status}`);
            }

            return data;
        } catch (error) {
            console.error('API Request Error:', error);
            throw error;
        }
    }

    // Updated Category Management Functions
    document.addEventListener('DOMContentLoaded', function() {
        // Load categories when page loads
        loadCategories();
        
        // Set user name in dropdown if element exists
        const userName = document.getElementById('userName');
        const dropdownUserName = document.getElementById('dropdownUserName');
        if (userName && dropdownUserName) {
            dropdownUserName.textContent = userName.textContent;
        }
        
        // Form submission for new category
        const categoryForm = document.getElementById('categoryForm');
        if (categoryForm) {
            categoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                addCategory();
            });
        }
        
        // Form submission for edit category
        const editCategoryForm = document.getElementById('editCategoryForm');
        if (editCategoryForm) {
            editCategoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                updateCategory();
            });
        }
        
        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                filterCategories(filter);
            });
        });
    });

    // Load categories from API
    async function loadCategories() {
        const loadingElement = document.getElementById('categoriesLoading');
        const emptyStateElement = document.getElementById('emptyState');
        const categoriesListElement = document.getElementById('categoriesList');
        
        // Show loading state
        if (loadingElement) loadingElement.classList.remove('hidden');
        if (categoriesListElement) categoriesListElement.innerHTML = '';
        if (emptyStateElement) emptyStateElement.classList.add('hidden');
        
        try {
            // Fetch categories and stats
            const [categories, stats] = await Promise.all([
                makeAPIRequest('/api/categories'),
                makeAPIRequest('/api/categories-stats')
            ]);
            
            // Update stats if elements exist
            const totalCategoriesEl = document.getElementById('totalCategories');
            const incomeCategoriesEl = document.getElementById('incomeCategories');
            const expenseCategoriesEl = document.getElementById('expenseCategories');
            
            if (stats && stats.data) {
                if (totalCategoriesEl) totalCategoriesEl.textContent = stats.data.total || 0;
                if (incomeCategoriesEl) incomeCategoriesEl.textContent = stats.data.income || 0;
                if (expenseCategoriesEl) expenseCategoriesEl.textContent = stats.data.expense || 0;
            }
            
            // Hide loading state
            if (loadingElement) loadingElement.classList.add('hidden');
            
            // Handle categories data
            const categoriesData = categories.data || categories;
            
            if (!categoriesData || categoriesData.length === 0) {
                if (emptyStateElement) emptyStateElement.classList.remove('hidden');
            } else {
                renderCategories(categoriesData);
            }
        } catch (error) {
            console.error('Error loading categories:', error);
            if (loadingElement) loadingElement.classList.add('hidden');
            showErrorToast('Error', 'Failed to load categories: ' + error.message);
        }
    }

    // Render categories in the list
    function renderCategories(categories) {
        const categoriesListElement = document.getElementById('categoriesList');
        if (!categoriesListElement) return;
        
        categoriesListElement.innerHTML = '';
        
        categories.forEach(category => {
            const categoryElement = document.createElement('div');
            categoryElement.className = `group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border ${category.type === 'income' ? 'border-green-200' : 'border-red-200'} p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden`;
            categoryElement.setAttribute('data-type', category.type);
            
            categoryElement.innerHTML = `
                <div class="absolute inset-0 ${category.type === 'income' ? 'bg-gradient-to-br from-green-100/20 to-green-200/10' : 'bg-gradient-to-br from-red-100/20 to-red-200/10'} opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 ${category.type === 'income' ? 'bg-gradient-to-br from-green-400 to-green-600' : 'bg-gradient-to-br from-red-400 to-red-600'} rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300 relative overflow-hidden">
                            <i class="fas ${category.type === 'income' ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down'} text-white text-lg"></i>
                            <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">${escapeHtml(category.name)}</h4>
                            <span class="text-xs font-semibold px-2 py-1 rounded-full ${category.type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${category.type.charAt(0).toUpperCase() + category.type.slice(1)}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-gray-500">${category.transactions_count || 0} transactions</span>
                        <button onclick="openEditModal(${category.id}, '${escapeHtml(category.name)}', '${category.type}')" class="p-2 text-gray-500 hover:text-[#4ADE80] hover:bg-white/50 rounded-xl transition-all duration-300">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button onclick="openDeleteModal(${category.id}, '${escapeHtml(category.name)}')" class="p-2 text-gray-500 hover:text-red-500 hover:bg-white/50 rounded-xl transition-all duration-300">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 ${category.type === 'income' ? 'bg-gradient-to-r from-green-400 to-green-600' : 'bg-gradient-to-r from-red-400 to-red-600'} transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            `;
            
            categoriesListElement.appendChild(categoryElement);
        });
    }

    // Escape HTML to prevent XSS
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Filter categories by type
    function filterCategories(type) {
        const allCategories = document.querySelectorAll('#categoriesList > div');
        
        allCategories.forEach(category => {
            if (type === 'all' || category.getAttribute('data-type') === type) {
                category.classList.remove('hidden');
            } else {
                category.classList.add('hidden');
            }
        });
    }

    // Add new category
    async function addCategory() {
        const form = document.getElementById('categoryForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitBtnText = document.getElementById('submitBtnText');
        const categoryNameInput = document.getElementById('categoryName');
        const typeInput = document.querySelector('input[name="type"]:checked');
        
        if (!categoryNameInput || !typeInput) {
            showErrorToast('Error', 'Please fill all required fields');
            return;
        }

        const formData = {
            name: categoryNameInput.value.trim(),
            type: typeInput.value
        };
        
        // Validation
        if (!formData.name || !formData.type) {
            showErrorToast('Error', 'Please fill all fields');
            return;
        }

        // Change button to loading state
        if (submitBtn) submitBtn.disabled = true;
        if (submitBtnText) submitBtnText.textContent = 'Adding...';
        
        try {
            await makeAPIRequest('/api/categories', {
                method: 'POST',
                body: JSON.stringify(formData)
            });
            
            showToast('Success!', 'Category added successfully');
            if (form) form.reset();
            loadCategories();
        } catch (error) {
            console.error('Error adding category:', error);
            showErrorToast('Error', error.message || 'Failed to add category');
        } finally {
            if (submitBtn) submitBtn.disabled = false;
            if (submitBtnText) submitBtnText.textContent = 'Add Category';
        }
    }

    // Edit Category Modal Functions
    function openEditModal(id, name, type) {
        const editCategoryId = document.getElementById('editCategoryId');
        const editCategoryName = document.getElementById('editCategoryName');
        const editTypeInput = document.querySelector(`input[name="editType"][value="${type}"]`);
        const editModal = document.getElementById('editModal');
        
        if (editCategoryId) editCategoryId.value = id;
        if (editCategoryName) editCategoryName.value = name;
        if (editTypeInput) editTypeInput.checked = true;
        if (editModal) editModal.classList.remove('hidden');
    }

    function closeEditModal() {
        const editModal = document.getElementById('editModal');
        if (editModal) editModal.classList.add('hidden');
    }

    async function updateCategory() {
        const editCategoryId = document.getElementById('editCategoryId');
        const editCategoryName = document.getElementById('editCategoryName');
        const editTypeInput = document.querySelector('input[name="editType"]:checked');
        const submitBtn = document.querySelector('#editCategoryForm button[type="submit"]');
        
        if (!editCategoryId || !editCategoryName || !editTypeInput) {
            showErrorToast('Error', 'Please fill all required fields');
            return;
        }

        const id = editCategoryId.value;
        const formData = {
            name: editCategoryName.value.trim(),
            type: editTypeInput.value
        };
        
        const originalBtnText = submitBtn ? submitBtn.textContent : 'Update Category';
        
        // Validation
        if (!formData.name || !formData.type) {
            showErrorToast('Error', 'Please fill all fields');
            return;
        }

        // Change button to loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Updating...';
        }
        
        try {
            await makeAPIRequest(`/api/categories/${id}`, {
                method: 'PUT',
                body: JSON.stringify(formData)
            });
            
            showToast('Success!', 'Category updated successfully');
            closeEditModal();
            loadCategories();
        } catch (error) {
            console.error('Error updating category:', error);
            showErrorToast('Error', error.message || 'Failed to update category');
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            }
        }
    }

    // Delete Category Modal Functions
    function openDeleteModal(id, name) {
        const deleteCategoryName = document.getElementById('deleteCategoryName');
        const deleteModal = document.getElementById('deleteModal');
        
        if (deleteCategoryName) deleteCategoryName.textContent = name;
        if (deleteModal) {
            deleteModal.setAttribute('data-category-id', id);
            deleteModal.classList.remove('hidden');
        }
    }

    function closeDeleteModal() {
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) deleteModal.classList.add('hidden');
    }

    async function confirmDelete() {
        const deleteModal = document.getElementById('deleteModal');
        const deleteCategoryName = document.getElementById('deleteCategoryName');
        const deleteBtn = document.querySelector('#deleteModal button[onclick="confirmDelete()"]');
        
        if (!deleteModal) return;
        
        const id = deleteModal.getAttribute('data-category-id');
        const name = deleteCategoryName ? deleteCategoryName.textContent : 'Category';
        const originalBtnText = deleteBtn ? deleteBtn.textContent : 'Delete';
        
        // Change button to loading state
        if (deleteBtn) {
            deleteBtn.disabled = true;
            deleteBtn.textContent = 'Deleting...';
        }
        
        try {
            await makeAPIRequest(`/api/categories/${id}`, {
                method: 'DELETE'
            });
            
            showToast('Deleted!', `Category "${name}" has been deleted`);
            closeDeleteModal();
            loadCategories();
        } catch (error) {
            console.error('Error deleting category:', error);
            showErrorToast('Error', error.message || 'Failed to delete category');
        } finally {
            if (deleteBtn) {
                deleteBtn.disabled = false;
                deleteBtn.textContent = originalBtnText;
            }
        }
    }
</script>
@endsection