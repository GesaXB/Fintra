<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fintra - Dashboard Keuangan</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
    }

    .sidebar {
      width: 280px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 0 25px 25px 0;
      padding: 2rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 3rem;
    }

    .logo-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(45deg, #27c281, #1a9660);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.2rem;
    }

    .logo h2 {
      color: #2d3748;
      font-weight: 700;
      font-size: 1.5rem;
    }

    .nav-menu {
      list-style: none;
    }

    .nav-item {
      margin-bottom: 8px;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      color: #4a5568;
      text-decoration: none;
      border-radius: 12px;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .nav-link:hover, .nav-link.active {
      background: linear-gradient(45deg, #27c281, #1a9660);
      color: white;
      transform: translateX(4px);
    }

    .logout-btn {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      color: #e53e3e;
      text-decoration: none;
      border-radius: 12px;
      transition: all 0.3s ease;
      font-weight: 500;
      background: none;
      border: none;
      width: 100%;
      cursor: pointer;
      margin-top: 2rem;
    }

    .logout-btn:hover {
      background: rgba(229, 62, 62, 0.1);
      transform: translateX(4px);
    }

    .main-content {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .header h1 {
      color: white;
      font-size: 2rem;
      font-weight: 700;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(255, 255, 255, 0.15);
      padding: 8px 16px;
      border-radius: 50px;
      backdrop-filter: blur(10px);
    }

    .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(45deg, #ff6b6b, #ee5a24);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 600;
    }

    .user-info h3 {
      color: white;
      font-size: 0.9rem;
      font-weight: 600;
    }

    .user-info p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.8rem;
    }

    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 1.5rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .balance-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .card-title {
      font-size: 0.9rem;
      font-weight: 500;
      opacity: 0.8;
    }

    .card-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
    }

    .balance-card .card-icon {
      background: rgba(255, 255, 255, 0.2);
      color: white;
    }

    .income-card .card-icon {
      background: rgba(39, 194, 129, 0.1);
      color: #27c281;
    }

    .expense-card .card-icon {
      background: rgba(255, 107, 107, 0.1);
      color: #ff6b6b;
    }

    .savings-card .card-icon {
      background: rgba(52, 219, 135, 0.1);
      color: #3498db;
    }

    .card-amount {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .card-change {
      font-size: 0.8rem;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .positive { color: #27c281; }
    .negative { color: #ff6b6b; }

    .dashboard-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .chart-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 1.5rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .recent-transactions {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 1.5rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 1rem;
    }

    .transaction-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #edf2f7;
    }

    .transaction-item:last-child {
      border-bottom: none;
    }

    .transaction-info {
      display: flex;
      align-items: center;
      gap: 12px;
      flex: 1;
    }

    .transaction-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
    }

    .transaction-details h4 {
      font-size: 0.9rem;
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 2px;
    }

    .transaction-details p {
      font-size: 0.8rem;
      color: #718096;
    }

    .transaction-amount {
      font-weight: 600;
      font-size: 0.9rem;
    }

    .quick-actions {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .action-btn {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border: none;
      border-radius: 15px;
      padding: 1rem;
      display: flex;
      align-items: center;
      gap: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      color: #2d3748;
      font-weight: 600;
      text-align: left;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }

    .action-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .action-icon {
      width: 35px;
      height: 35px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
    }

    .loading {
      display: none;
      color: white;
      text-align: center;
      margin: 2rem 0;
    }

    .loading.show {
      display: block;
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }
      
      .sidebar {
        width: 100%;
        border-radius: 0;
        padding: 1rem;
      }
      
      .dashboard-grid {
        grid-template-columns: 1fr;
      }
      
      .cards-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <div class="logo-icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <h2>Fintra</h2>
    </div>
    
    <ul class="nav-menu">
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <i class="fas fa-home"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-exchange-alt"></i>
          Transaksi
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-chart-pie"></i>
          Anggaran
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-piggy-bank"></i>
          Tabungan
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-chart-line"></i>
          Laporan
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-bell"></i>
          Notifikasi
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-cog"></i>
          Pengaturan
        </a>
      </li>
    </ul>
    
    <button class="logout-btn" onclick="logout()">
      <i class="fas fa-sign-out-alt"></i>
      Logout
    </button>
  </div>

  <div class="main-content">
    <div class="loading" id="loading">
      <i class="fas fa-spinner fa-spin"></i> Memuat data...
    </div>

    <div class="header">
      <h1>Dashboard Keuangan</h1>
      <div class="user-profile">
        <div class="avatar" id="userAvatar">G</div>
        <div class="user-info">
          <h3 id="userName">Loading...</h3>
          <p>Premium User</p>
        </div>
      </div>
    </div>

    <div class="cards-grid">
      <div class="card balance-card">
        <div class="card-header">
          <span class="card-title">Total Saldo</span>
          <div class="card-icon">
            <i class="fas fa-wallet"></i>
          </div>
        </div>
        <div class="card-amount" id="totalBalance">Rp 0</div>
        <div class="card-change positive">
          <i class="fas fa-arrow-up"></i>
          <span id="balanceChange">Loading...</span>
        </div>
      </div>

      <div class="card income-card">
        <div class="card-header">
          <span class="card-title">Pendapatan Bulan Ini</span>
          <div class="card-icon">
            <i class="fas fa-arrow-up"></i>
          </div>
        </div>
        <div class="card-amount" id="monthlyIncome">Rp 0</div>
        <div class="card-change positive">
          <i class="fas fa-arrow-up"></i>
          <span id="incomeChange">Loading...</span>
        </div>
      </div>

      <div class="card expense-card">
        <div class="card-header">
          <span class="card-title">Pengeluaran Bulan Ini</span>
          <div class="card-icon">
            <i class="fas fa-arrow-down"></i>
          </div>
        </div>
        <div class="card-amount" id="monthlyExpense">Rp 0</div>
        <div class="card-change negative">
          <i class="fas fa-arrow-up"></i>
          <span id="expenseChange">Loading...</span>
        </div>
      </div>

      <div class="card savings-card">
        <div class="card-header">
          <span class="card-title">Target Tabungan</span>
          <div class="card-icon">
            <i class="fas fa-piggy-bank"></i>
          </div>
        </div>
        <div class="card-amount" id="savingsTarget">Rp 0</div>
        <div class="card-change positive">
          <i class="fas fa-chart-line"></i>
          <span id="savingsProgress">Loading...</span>
        </div>
      </div>
    </div>

    <div class="dashboard-grid">
      <div class="chart-container">
        <h3 class="section-title">Grafik Keuangan Bulanan</h3>
        <canvas id="financeChart" width="400" height="200"></canvas>
      </div>

      <div class="recent-transactions">
        <h3 class="section-title">Transaksi Terbaru</h3>
        <div id="transactionsList">
          <div class="transaction-item">
            <div class="transaction-info">
              <div class="transaction-icon" style="background: rgba(39, 194, 129, 0.1); color: #27c281;">
                <i class="fas fa-plus"></i>
              </div>
              <div class="transaction-details">
                <h4>Loading...</h4>
                <p>Loading...</p>
              </div>
            </div>
            <div class="transaction-amount">Loading...</div>
          </div>
        </div>
      </div>
    </div>

    <div class="chart-container">
      <h3 class="section-title">Aksi Cepat</h3>
      <div class="quick-actions">
        <button class="action-btn" onclick="addTransaction()">
          <div class="action-icon" style="background: rgba(39, 194, 129, 0.1); color: #27c281;">
            <i class="fas fa-plus"></i>
          </div>
          <span>Tambah Transaksi</span>
        </button>
        
        <button class="action-btn" onclick="createBudget()">
          <div class="action-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
            <i class="fas fa-chart-pie"></i>
          </div>
          <span>Buat Anggaran</span>
        </button>
        
        <button class="action-btn" onclick="setSavingGoal()">
          <div class="action-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
            <i class="fas fa-target"></i>
          </div>
          <span>Target Menabung</span>
        </button>
        
        <button class="action-btn" onclick="generateReport()">
          <div class="action-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
            <i class="fas fa-file-alt"></i>
          </div>
          <span>Laporan Keuangan</span>
        </button>
      </div>
    </div>
  </div>

  <script>
    let financeChart;

    // Authentication Functions
    function checkAuth() {
      const token = localStorage.getItem('auth_token');
      if (!token) {
        window.location.href = '/login';
        return false;
      }
      return true;
    }

    async function makeAuthenticatedRequest(url, options = {}) {
      const token = localStorage.getItem('auth_token');
      
      const defaultOptions = {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
      };
      
      const mergedOptions = {
        ...defaultOptions,
        ...options,
        headers: {
          ...defaultOptions.headers,
          ...options.headers
        }
      };
      
      try {
        const response = await fetch(url, mergedOptions);
        
        if (response.status === 401) {
          localStorage.removeItem('auth_token');
          localStorage.removeItem('user');
          window.location.href = '/login';
          return;
        }
        
        return response;
      } catch (error) {
        console.error('Request failed:', error);
        throw error;
      }
    }

    async function logout() {
      try {
        const loading = document.getElementById('loading');
        loading.classList.add('show');

        await makeAuthenticatedRequest('/api/logout', {
          method: 'POST'
        });
      } catch (error) {
        console.error('Logout error:', error);
      } finally {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        window.location.href = '/login';
      }
    }

    // Load User Data
    async function loadUserData() {
      try {
        const response = await makeAuthenticatedRequest('/api/user');
        const data = await response.json();
        
        if (data.success) {
          const user = data.user;
          document.getElementById('userName').textContent = user.name;
          document.getElementById('userAvatar').textContent = user.name.charAt(0).toUpperCase();
          
          localStorage.setItem('user', JSON.stringify(user));
        }
      } catch (error) {
        console.error('Failed to load user data:', error);
      }
    }

    // Load Dashboard Data (Mock data since we don't have real endpoints yet)
    async function loadDashboardData() {
      try {
        const loading = document.getElementById('loading');
        loading.classList.add('show');

        // Simulate API delay
        await new Promise(resolve => setTimeout(resolve, 1000));

        // Mock data - replace with real API calls when available
        const mockData = {
          totalBalance: 45750000,
          monthlyIncome: 12500000,
          monthlyExpense: 8750000,
          savingsTarget: 25000000,
          savingsProgress: 75,
          balanceChange: '+12.5% dari bulan lalu',
          incomeChange: '+8.2%',
          expenseChange: '+15.3%',
          transactions: [
            {
              id: 1,
              type: 'income',
              description: 'Gaji Bulanan',
              amount: 12500000,
              date: '25 Mei 2025',
              icon: 'fas fa-plus',
              color: '#27c281'
            },
            {
              id: 2,
              type: 'expense',
              description: 'Belanja Groceries',
              amount: -750000,
              date: '24 Mei 2025',
              icon: 'fas fa-shopping-cart',
              color: '#ff6b6b'
            },
            {
              id: 3,
              type: 'expense',
              description: 'Bensin & Transportasi',
              amount: -350000,
              date: '23 Mei 2025',
              icon: 'fas fa-car',
              color: '#3498db'
            },
            {
              id: 4,
              type: 'expense',
              description: 'Hiburan',
              amount: -200000,
              date: '22 Mei 2025',
              icon: 'fas fa-film',
              color: '#9b59b6'
            },
            {
              id: 5,
              type: 'income',
              description: 'Freelance Project',
              amount: 2500000,
              date: '20 Mei 2025',
              icon: 'fas fa-briefcase',
              color: '#27c281'
            }
          ]
        };

        updateDashboardUI(mockData);
        
        loading.classList.remove('show');
      } catch (error) {
        console.error('Failed to load dashboard data:', error);
        document.getElementById('loading').classList.remove('show');
      }
    }

    function updateDashboardUI(data) {
      // Update cards
      document.getElementById('totalBalance').textContent = formatCurrency(data.totalBalance);
      document.getElementById('monthlyIncome').textContent = formatCurrency(data.monthlyIncome);
      document.getElementById('monthlyExpense').textContent = formatCurrency(data.monthlyExpense);
      document.getElementById('savingsTarget').textContent = formatCurrency(data.savingsTarget);
      
      document.getElementById('balanceChange').textContent = data.balanceChange;
      document.getElementById('incomeChange').textContent = data.incomeChange;
      document.getElementById('expenseChange').textContent = data.expenseChange;
      document.getElementById('savingsProgress').textContent = `${data.savingsProgress}% tercapai`;

      // Update transactions
      updateTransactionsList(data.transactions);
      
      // Update chart
      updateFinanceChart();
    }

    function updateTransactionsList(transactions) {
      const container = document.getElementById('transactionsList');
      container.innerHTML = '';
      
      transactions.forEach(transaction => {
        const item = document.createElement('div');
        item.className = 'transaction-item';
        
        const amountClass = transaction.amount > 0 ? 'positive' : 'negative';
        const amountSign = transaction.amount > 0 ? '+' : '';
        
        item.innerHTML = `
          <div class="transaction-info">
            <div class="transaction-icon" style="background: rgba(${transaction.color === '#27c281' ? '39, 194, 129' : transaction.color === '#ff6b6b' ? '255, 107, 107' : transaction.color === '#3498db' ? '52, 152, 219' : '155, 89, 182'}, 0.1); color: ${transaction.color};">
              <i class="${transaction.icon}"></i>
            </div>
            <div class="transaction-details">
              <h4>${transaction.description}</h4>
              <p>${transaction.date}</p>
            </div>
          </div>
          <div class="transaction-amount ${amountClass}">${amountSign}${formatCurrency(Math.abs(transaction.amount))}</div>
        `;
        
        container.appendChild(item);
      });
    }

    function formatCurrency(amount) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
      }).format(amount);
    }

    function updateFinanceChart() {
      const ctx = document.getElementById('financeChart').getContext('2d');
      
      if (financeChart) {
        financeChart.destroy();
      }
      
      financeChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
          datasets: [{
            label: 'Pendapatan',
            data: [10000000, 11500000, 9800000, 12200000, 12500000, 13000000],
            borderColor: '#27c281',
            backgroundColor: 'rgba(39, 194, 129, 0.1)',
            tension: 0.4,
            fill: true
          }, {
            label: 'Pengeluaran',
            data: [7500000, 8200000, 7800000, 8900000, 8750000, 9200000],
            borderColor: '#ff6b6b',
            backgroundColor: 'rgba(255, 107, 107, 0.1)',
            tension: 0.4,
            fill: true
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return 'Rp ' + (value / 1000000) + 'M';
                }
              }
            }
          }
        }
      });
    }

    // Quick Actions Functions
    function addTransaction() {
      alert('Fitur Tambah Transaksi akan segera hadir!');
    }

    function createBudget() {
      alert('Fitur Buat Anggaran akan segera hadir!');
    }

    function setSavingGoal() {
      alert('Fitur Target Menabung akan segera hadir!');
    }

    function generateReport() {
      alert('Fitur Laporan Keuangan akan segera hadir!');
    }

    // Navigation Functions
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // Initialize Dashboard
    document.addEventListener('DOMContentLoaded', async function() {
      if (!checkAuth()) return;
      
      await loadUserData();
      await loadDashboardData();
      
      // Refresh data every 5 minutes
      setInterval(loadDashboardData, 300000);
    });

    // Card hover effects
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px) scale(1.02)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
      });
    });
  </script>
</body>
</html>