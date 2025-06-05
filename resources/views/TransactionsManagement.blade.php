<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fintra - Transactions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
        }

        .header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #4CAF50;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: #666;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .nav-link.active {
            color: #4CAF50;
            background: #f0f8f0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #4CAF50;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-value.income { color: #4CAF50; }
        .stat-value.expense { color: #f44336; }
        .stat-value.total { color: #2196F3; }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2rem;
        }

        .transactions-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            background: #f5f5f5;
            padding: 0.3rem;
            border-radius: 8px;
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            border: none;
            background: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .filter-tab.active {
            background: #4CAF50;
            color: white;
        }

        .search-bar {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: border-color 0.3s;
        }

        .search-bar:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .transaction-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .transaction-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .transaction-item:hover {
            border-color: #4CAF50;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.1);
        }

        .transaction-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .transaction-icon.income {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
        }

        .transaction-icon.expense {
            background: linear-gradient(135deg, #f44336, #EF5350);
            color: white;
        }

        .transaction-details {
            flex: 1;
        }

        .transaction-title {
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 0.3rem;
        }

        .transaction-category {
            color: #666;
            font-size: 0.9rem;
        }

        .transaction-amount {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .transaction-amount.income {
            color: #4CAF50;
        }

        .transaction-amount.expense {
            color: #f44336;
        }

        .transaction-date {
            color: #999;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .add-transaction-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .form-select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            background: white;
        }

        .type-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .type-option {
            flex: 1;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .type-option.selected.income {
            border-color: #4CAF50;
            background: #f0f8f0;
            color: #4CAF50;
        }

        .type-option.selected.expense {
            border-color: #f44336;
            background: #fff0f0;
            color: #f44336;
        }

        .btn-primary {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .quick-stats {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .quick-stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .quick-stat-item:last-child {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
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


    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Transaction Management</h1>
            <p class="page-subtitle">
                Track and manage all your financial transactions with detailed insights
                and organized categorization
            </p>
        </div>

        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-value total">247</div>
                <div class="stat-label">Total Transactions</div>
            </div>
            <div class="stat-card">
                <div class="stat-value income">Rp 15.750.000</div>
                <div class="stat-label">Total Income</div>
            </div>
            <div class="stat-card">
                <div class="stat-value expense">Rp 8.250.000</div>
                <div class="stat-label">Total Expenses</div>
            </div>
            <div class="stat-card">
                <div class="stat-value total">Rp 7.500.000</div>
                <div class="stat-label">Net Balance</div>
            </div>
        </div>

        <div class="main-content">
            <div class="transactions-section">
                <div class="section-header">
                    <h2 class="section-title">Recent Transactions</h2>
                    <div class="filter-tabs">
                        <button class="filter-tab active" onclick="filterTransactions('all')">All</button>
                        <button class="filter-tab" onclick="filterTransactions('income')">Income</button>
                        <button class="filter-tab" onclick="filterTransactions('expense')">Expense</button>
                    </div>
                </div>

                <input type="text" class="search-bar" placeholder="Search transactions..." onkeyup="searchTransactions(this.value)">

                <div class="transaction-list" id="transactionList">
                    <div class="transaction-item" data-type="income">
                        <div class="transaction-icon income">💰</div>
                        <div class="transaction-details">
                            <div class="transaction-title">Salary Payment</div>
                            <div class="transaction-category">Salary • Work Income</div>
                            <div class="transaction-date">Today, 09:30 AM</div>
                        </div>
                        <div class="transaction-amount income">+Rp 5.000.000</div>
                    </div>

                    <div class="transaction-item" data-type="expense">
                        <div class="transaction-icon expense">🛒</div>
                        <div class="transaction-details">
                            <div class="transaction-title">Grocery Shopping</div>
                            <div class="transaction-category">Food & Dining • Supermarket</div>
                            <div class="transaction-date">Yesterday, 02:15 PM</div>
                        </div>
                        <div class="transaction-amount expense">-Rp 450.000</div>
                    </div>

                    <div class="transaction-item" data-type="income">
                        <div class="transaction-icon income">📈</div>
                        <div class="transaction-details">
                            <div class="transaction-title">Investment Return</div>
                            <div class="transaction-category">Investment • Stock Dividend</div>
                            <div class="transaction-date">2 days ago, 11:00 AM</div>
                        </div>
                        <div class="transaction-amount income">+Rp 1.250.000</div>
                    </div>

                    <div class="transaction-item" data-type="expense">
                        <div class="transaction-icon expense">⛽</div>
                        <div class="transaction-details">
                            <div class="transaction-title">Fuel Purchase</div>
                            <div class="transaction-category">Transportation • Gas Station</div>
                            <div class="transaction-date">3 days ago, 08:45 AM</div>
                        </div>
                        <div class="transaction-amount expense">-Rp 200.000</div>
                    </div>

                    <div class="transaction-item" data-type="expense">
                        <div class="transaction-icon expense">🏥</div>
                        <div class="transaction-details">
                            <div class="transaction-title">Medical Checkup</div>
                            <div class="transaction-category">Healthcare • Hospital</div>
                            <div class="transaction-date">5 days ago, 10:30 AM</div>
                        </div>
                        <div class="transaction-amount expense">-Rp 750.000</div>
                    </div>

                    <div class="transaction-item" data-type="income">
                        <div class="transaction-icon income">💼</div>
                        <div class="transaction-details">
                            <div class="transaction-title">Freelance Project</div>
                            <div class="transaction-category">Work • Consulting</div>
                            <div class="transaction-date">1 week ago, 04:20 PM</div>
                        </div>
                        <div class="transaction-amount income">+Rp 2.500.000</div>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="add-transaction-form">
                    <h3 class="section-title" style="margin-bottom: 1.5rem;">Add New Transaction</h3>

                    <div class="form-group">
                        <label class="form-label">Transaction Type</label>
                        <div class="type-selector">
                            <div class="type-option selected income" onclick="selectType('income')">
                                📈 Income
                            </div>
                            <div class="type-option" onclick="selectType('expense')">
                                📉 Expense
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Transaction Title</label>
                        <input type="text" class="form-input" placeholder="Enter transaction title..." id="transactionTitle">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Amount (Rp)</label>
                        <input type="number" class="form-input" placeholder="0" id="transactionAmount">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select class="form-select" id="transactionCategory">
                            <option>Select category...</option>
                            <option>Food & Dining</option>
                            <option>Transportation</option>
                            <option>Entertainment</option>
                            <option>Healthcare</option>
                            <option>Shopping</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-input" id="transactionDate">
                    </div>

                    <button class="btn-primary" onclick="addTransaction()">Add Transaction</button>
                </div>

                <div class="quick-stats">
                    <h3 class="section-title" style="margin-bottom: 1rem;">This Month Summary</h3>
                    <div class="quick-stat-item">
                        <span>Total Income</span>
                        <span style="color: #4CAF50; font-weight: bold;">Rp 8.750.000</span>
                    </div>
                    <div class="quick-stat-item">
                        <span>Total Expenses</span>
                        <span style="color: #f44336; font-weight: bold;">Rp 3.250.000</span>
                    </div>
                    <div class="quick-stat-item">
                        <span>Transactions</span>
                        <span style="font-weight: bold;">47</span>
                    </div>
                    <div class="quick-stat-item">
                        <span>Average per day</span>
                        <span style="font-weight: bold;">Rp 183.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedType = 'income';
        let transactions = document.querySelectorAll('.transaction-item');

        function selectType(type) {
            selectedType = type;
            document.querySelectorAll('.type-option').forEach(option => {
                option.classList.remove('selected', 'income', 'expense');
            });
            document.querySelector('.type-option').classList.add('selected', type);
            event.target.classList.add('selected', type);
        }

        function filterTransactions(type) {
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter transactions
            transactions.forEach(transaction => {
                if (type === 'all' || transaction.dataset.type === type) {
                    transaction.style.display = 'flex';
                } else {
                    transaction.style.display = 'none';
                }
            });
        }

        function searchTransactions(query) {
            transactions.forEach(transaction => {
                const title = transaction.querySelector('.transaction-title').textContent.toLowerCase();
                const category = transaction.querySelector('.transaction-category').textContent.toLowerCase();

                if (title.includes(query.toLowerCase()) || category.includes(query.toLowerCase())) {
                    transaction.style.display = 'flex';
                } else {
                    transaction.style.display = 'none';
                }
            });
        }

        function addTransaction() {
            const title = document.getElementById('transactionTitle').value;
            const amount = document.getElementById('transactionAmount').value;
            const category = document.getElementById('transactionCategory').value;
            const date = document.getElementById('transactionDate').value;

            if (!title || !amount || !category || !date) {
                alert('Please fill in all fields');
                return;
            }

            // Create new transaction element
            const transactionList = document.getElementById('transactionList');
            const newTransaction = document.createElement('div');
            newTransaction.className = 'transaction-item';
            newTransaction.dataset.type = selectedType;

            const emoji = selectedType === 'income' ? '💰' : '🛒';
            const sign = selectedType === 'income' ? '+' : '-';
            const amountClass = selectedType === 'income' ? 'income' : 'expense';

            newTransaction.innerHTML = `
                <div class="transaction-icon ${selectedType}">${emoji}</div>
                <div class="transaction-details">
                    <div class="transaction-title">${title}</div>
                    <div class="transaction-category">${category}</div>
                    <div class="transaction-date">Just now</div>
                </div>
                <div class="transaction-amount ${amountClass}">${sign}Rp ${parseInt(amount).toLocaleString('id-ID')}</div>
            `;

            // Add to beginning of list
            transactionList.insertBefore(newTransaction, transactionList.firstChild);

            // Clear form
            document.getElementById('transactionTitle').value = '';
            document.getElementById('transactionAmount').value = '';
            document.getElementById('transactionCategory').value = '';
            document.getElementById('transactionDate').value = '';

            // Update transactions array
            transactions = document.querySelectorAll('.transaction-item');

            // Show success message
            alert('Transaction added successfully!');
        }

        // Set today's date as default
        document.getElementById('transactionDate').valueAsDate = new Date();
    </script>
</body>
</html>
