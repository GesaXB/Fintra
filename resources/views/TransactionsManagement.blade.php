<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fintra - Transactions</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Modern UI Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            color: #333;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        /* Animated Background Elements */
        .bg-elements {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .bg-circle-1 {
            position: absolute;
            top: -10rem;
            right: -10rem;
            width: 20rem;
            height: 20rem;
            background: linear-gradient(135deg, rgba(74, 222, 128, 0.2) 0%, rgba(110, 231, 183, 0.2) 100%);
            border-radius: 50%;
            filter: blur(3rem);
            animation: pulse 4s infinite;
        }

        .bg-circle-2 {
            position: absolute;
            bottom: -10rem;
            left: -10rem;
            width: 24rem;
            height: 24rem;
            background: linear-gradient(135deg, rgba(110, 231, 183, 0.2) 0%, rgba(74, 222, 128, 0.2) 100%);
            border-radius: 50%;
            filter: blur(3rem);
            animation: pulse 4s infinite 2s;
        }

        .bg-circle-3 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 16rem;
            height: 16rem;
            background: linear-gradient(135deg, rgba(110, 231, 183, 0.2) 0%, rgba(74, 222, 128, 0.2) 100%);
            border-radius: 50%;
            filter: blur(2rem);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }

        @keyframes float {
            0%, 100% { transform: translate(-50%, -50%) translateY(0); }
            50% { transform: translate(-50%, -50%) translateY(-20px); }
        }

        /* Header Styles */
        .header {
            position: relative;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(1rem);
            border-bottom: 1px solid rgba(74, 222, 128, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 50;
            position: sticky;
            top: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .logo-icon {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, #4ADE80, #2ECC71);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .logo:hover .logo-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 900;
            background: linear-gradient(to right, #2C3E50, #4B6CB7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: #666;
            font-weight: 500;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            color: #666;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #4ADE80;
            background: rgba(74, 222, 128, 0.1);
        }

        .nav-link.active {
            color: #4ADE80;
            background: rgba(74, 222, 128, 0.1);
            font-weight: 600;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #4ADE80, #2ECC71);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 1.5rem;
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .user-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .page-title {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(to right, #2C3E50, #4B6CB7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .title-divider {
            height: 0.25rem;
            width: 6rem;
            background: linear-gradient(to right, #4ADE80, #2ECC71);
            border-radius: 0.25rem;
            margin: 1rem auto;
        }

        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            position: relative;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(1rem);
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
            animation-fill-mode: backwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(74, 222, 128, 0.05), rgba(110, 231, 183, 0.05));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0.25rem;
            background: linear-gradient(to right, #4ADE80, #2ECC71);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s;
        }

        .stat-card:hover::after {
            transform: scaleX(1);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-value.income { color: #4ADE80; }
        .stat-value.expense { color: #EF4444; }
        .stat-value.total { color: #3B82F6; }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* Main Content Grid */
        .main-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            animation: fadeIn 0.5s ease-out 0.3s both;
        }

        @media (min-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr 350px;
            }
        }

        /* Transactions Section */
        .transactions-section {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(1rem);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.2);
        }

        .section-header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .section-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            background: rgba(244, 244, 244, 0.8);
            padding: 0.5rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(74, 222, 128, 0.2);
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            border: none;
            background: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .filter-tab:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .filter-tab.active {
            background: linear-gradient(135deg, #4ADE80, #2ECC71);
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-bar {
            width: 100%;
            padding: 1rem;
            border: 1px solid rgba(74, 222, 128, 0.3);
            border-radius: 0.75rem;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0.5rem);
        }

        .search-bar:focus {
            outline: none;
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.2);
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
            border: 1px solid rgba(74, 222, 128, 0.2);
            border-radius: 0.75rem;
            transition: all 0.3s;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0.5rem);
            position: relative;
            overflow: hidden;
        }

        .transaction-item:hover {
            border-color: #4ADE80;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 222, 128, 0.1);
        }

        .transaction-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0.25rem;
            height: 100%;
            background: #4ADE80;
            transition: all 0.3s;
            opacity: 0;
        }

        .transaction-item.income:hover::before {
            opacity: 1;
            background: #4ADE80;
        }

        .transaction-item.expense:hover::before {
            opacity: 1;
            background: #EF4444;
        }

        .transaction-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .transaction-icon.income {
            background: linear-gradient(135deg, #4ADE80, #2ECC71);
            color: white;
        }

        .transaction-icon.expense {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
        }

        .transaction-details {
            flex: 1;
            min-width: 0;
        }

        .transaction-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 0.3rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .transaction-category {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .transaction-amount {
            font-weight: 700;
            font-size: 1.2rem;
            margin-left: 1rem;
            flex-shrink: 0;
        }

        .transaction-amount.income {
            color: #4ADE80;
        }

        .transaction-amount.expense {
            color: #EF4444;
        }

        .transaction-date {
            color: #999;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        .transaction-actions {
            display: flex;
            gap: 0.5rem;
            margin-left: 1rem;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Add Transaction Form */
        .add-transaction-form {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(1rem);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.2);
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
            padding: 1rem;
            border: 1px solid rgba(74, 222, 128, 0.3);
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0.5rem);
        }

        .form-input:focus {
            outline: none;
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.2);
        }

        .form-select {
            width: 100%;
            padding: 1rem;
            border: 1px solid rgba(74, 222, 128, 0.3);
            border-radius: 0.75rem;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0.5rem);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23666' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }

        .form-select:focus {
            outline: none;
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.2);
        }

        .type-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .type-option {
            padding: 1rem;
            border: 1px solid rgba(74, 222, 128, 0.3);
            border-radius: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0.5rem);
            font-weight: 500;
        }

        .type-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .type-option.selected.income {
            border-color: #4ADE80;
            background: rgba(74, 222, 128, 0.1);
            color: #4ADE80;
            font-weight: 600;
        }

        .type-option.selected.expense {
            border-color: #EF4444;
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            font-weight: 600;
        }

        .btn-primary {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #4ADE80, #2ECC71);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #2ECC71, #4ADE80);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Quick Stats */
        .quick-stats {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(1rem);
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.2);
        }

        .quick-stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(74, 222, 128, 0.2);
        }

        .quick-stat-item:last-child {
            border-bottom: none;
        }

        .quick-stat-label {
            color: #666;
            font-weight: 500;
        }

        .quick-stat-value {
            font-weight: 600;
        }

        .quick-stat-value.income {
            color: #4ADE80;
        }

        .quick-stat-value.expense {
            color: #EF4444;
        }

        /* Loading State */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: #666;
            flex-direction: column;
            gap: 1rem;
        }

        .loading-spinner {
            width: 3rem;
            height: 3rem;
            border: 0.25rem solid rgba(74, 222, 128, 0.2);
            border-top-color: #4ADE80;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Messages */
        .error-message {
            background: rgba(254, 226, 226, 0.8);
            color: #DC2626;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(220, 38, 38, 0.2);
            backdrop-filter: blur(0.5rem);
        }

        .success-message {
            background: rgba(209, 250, 229, 0.8);
            color: #059669;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(5, 150, 105, 0.2);
            backdrop-filter: blur(0.5rem);
        }

        /* Delete Button */
        .delete-btn {
            background: #EF4444;
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            transition: all 0.3s;
        }

        .delete-btn:hover {
            background: #DC2626;
            transform: scale(1.1);
        }

        /* Edit Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(0.5rem);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(1rem);
            border-radius: 1rem;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px);
            transition: all 0.3s;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
            transition: all 0.3s;
        }

        .modal-close:hover {
            color: #333;
            transform: rotate(90deg);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: 1fr 1fr;
            }

            .type-selector {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 2rem;
            }

            .transaction-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .transaction-amount {
                margin-left: 0;
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background Elements -->
    <div class="bg-elements">
        <div class="bg-circle-1"></div>
        <div class="bg-circle-2"></div>
        <div class="bg-circle-3"></div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <div class="logo-text">Fintra</div>
                <div class="logo-subtext">Financial Tracker</div>
            </div>
        </div>
        <nav class="nav-links">
            <a href="#" class="nav-link">Dashboard</a>
            <a href="#" class="nav-link active">Transactions</a>
            <a href="#" class="nav-link">Categories</a>
            <a href="#" class="nav-link">Reports</a>
        </nav>
        <div class="user-profile" id="userProfile">
            <span><i class="fas fa-user"></i></span>
            <span id="userName">Loading...</span>
        </div>
    </header>

    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Transaction Management</h1>
            <p class="page-subtitle">
                Track and manage all your financial transactions with detailed insights
                and organized categorization
            </p>
            <div class="title-divider"></div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-cards" id="statsCards">
            <div class="stat-card">
                <div class="stat-value total" id="totalTransactions">0</div>
                <div class="stat-label">Total Transactions</div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #3B82F6, #2563EB);">
                    <i class="fas fa-exchange-alt"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-value income" id="totalIncome">Rp 0</div>
                <div class="stat-label">Total Income</div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #4ADE80, #2ECC71);">
                    <i class="fas fa-arrow-trend-up"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-value expense" id="totalExpense">Rp 0</div>
                <div class="stat-label">Total Expenses</div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #EF4444, #DC2626);">
                    <i class="fas fa-arrow-trend-down"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-value total" id="netBalance">Rp 0</div>
                <div class="stat-label">Net Balance</div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #8B5CF6, #7C3AED);">
                    <i class="fas fa-balance-scale"></i>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Transactions List -->
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

                <div id="transactionsMessage"></div>
                <div class="transaction-list" id="transactionList">
                    <div class="loading">
                        <div class="loading-spinner"></div>
                        <p>Loading transactions...</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Add Transaction Form -->
                <div class="add-transaction-form">
                    <h3 class="section-title" style="margin-bottom: 1.5rem;">Add New Transaction</h3>

                    <div id="formMessage"></div>

                    <div class="form-group">
                        <label class="form-label">Transaction Type</label>
                        <div class="type-selector">
                            <div class="type-option selected income" onclick="selectType('income')">
                                <i class="fas fa-arrow-trend-up"></i> Income
                            </div>
                            <div class="type-option" onclick="selectType('expense')">
                                <i class="fas fa-arrow-trend-down"></i> Expense
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-input" placeholder="Enter transaction description..." id="transactionDescription">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Amount (Rp)</label>
                        <input type="number" class="form-input" placeholder="0" id="transactionAmount" step="0.01" min="0.01">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select class="form-select" id="transactionCategory">
                            <option value="">Select category...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-input" id="transactionDate">
                    </div>

                    <button class="btn-primary" onclick="addTransaction()" id="addBtn">
                        <i class="fas fa-plus"></i> Add Transaction
                    </button>
                </div>

                <!-- Quick Stats -->
                <div class="quick-stats">
                    <h3 class="section-title" style="margin-bottom: 1rem;">Monthly Summary</h3>
                    <div id="quickStatsContent">
                        <div class="loading">
                            <div class="loading-spinner"></div>
                            <p>Loading summary...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Transaction Modal -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Transaction</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <div id="editModalContent">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Configuration
        const API_BASE_URL = '/api';
        let selectedType = 'income';
        let allTransactions = [];
        let allCategories = [];
        let authToken = '';
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // API Helper function
        async function apiRequest(endpoint, options = {}) {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            };

            if (authToken) {
                defaultOptions.headers['Authorization'] = `Bearer ${authToken}`;
            }

            const config = {
                ...defaultOptions,
                ...options,
                headers: { ...defaultOptions.headers, ...options.headers }
            };

            try {
                const response = await fetch(`${API_BASE_URL}${endpoint}`, config);
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || `HTTP error! status: ${response.status}`);
                }
                
                return data;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }

        // Initialize the application
        async function init() {
            try {
                await loadUser();
                await loadTransactions();
                await loadCategories();
                await loadSummary();
                setDefaultDate();
            } catch (error) {
                console.error('Initialization error:', error);
                showMessage('Error loading data. Please refresh the page.', 'error');
            }
        }

        // Load user data
        async function loadUser() {
            try {
                const response = await apiRequest('/user');
                document.getElementById('userName').textContent = response.name || 'User';
            } catch (error) {
                console.error('Error loading user:', error);
                document.getElementById('userName').textContent = 'User';
            }
        }

        // Load transactions
        async function loadTransactions() {
            try {
                const response = await apiRequest('/transactions');
                allTransactions = response.data || [];
                displayTransactions(allTransactions);
                updateStats();
            } catch (error) {
                console.error('Error loading transactions:', error);
                document.getElementById('transactionList').innerHTML = 
                    '<div class="error-message">Failed to load transactions. Please try again.</div>';
            }
        }

        // Load categories
        async function loadCategories() {
            try {
                const response = await apiRequest('/transactions-categories');
                allCategories = response.data || [];
                updateCategoryOptions();
            } catch (error) {
                console.error('Error loading categories:', error);
                showMessage('Failed to load categories', 'error');
            }
        }

        // Load summary data
        async function loadSummary() {
            try {
                const response = await apiRequest('/transactions-summary');
                const summary = response.data;
                updateQuickStats(summary);
            } catch (error) {
                console.error('Error loading summary:', error);
                document.getElementById('quickStatsContent').innerHTML = 
                    '<div class="error-message">Failed to load summary</div>';
            }
        }

        // Display transactions
        function displayTransactions(transactions) {
            const listElement = document.getElementById('transactionList');
            
            if (!transactions || transactions.length === 0) {
                listElement.innerHTML = `
                    <div class="empty-state">
                        <div style="width: 6rem; height: 6rem; background: rgba(74, 222, 128, 0.1); border-radius: 1.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                            <i class="fas fa-exchange-alt" style="color: #4ADE80; font-size: 2rem;"></i>
                        </div>
                        <h4 style="font-size: 1.25rem; font-weight: 600; color: #333; margin-bottom: 0.5rem;">No transactions found</h4>
                        <p style="color: #666; max-width: 20rem; margin: 0 auto;">Start tracking your finances by adding your first transaction</p>
                    </div>
                `;
                return;
            }

            listElement.innerHTML = transactions.map(transaction => {
                const date = new Date(transaction.transaction_date);
                const formattedDate = date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
                
                const icon = transaction.type === 'income' ? '💰' : '🛒';
                const sign = transaction.type === 'income' ? '+' : '-';
                const amount = parseFloat(transaction.amount);
                
                return `
                    <div class="transaction-item ${transaction.type}" data-type="${transaction.type}" data-id="${transaction.id}">
                        <div class="transaction-icon ${transaction.type}">${icon}</div>
                        <div class="transaction-details">
                            <div class="transaction-title">${transaction.description}</div>
                            <div class="transaction-category">${transaction.category?.name || 'No Category'}</div>
                            <div class="transaction-date">${formattedDate}</div>
                        </div>
                        <div class="transaction-amount ${transaction.type}">
                            ${sign}Rp ${amount.toLocaleString('id-ID')}
                        </div>
                        <div class="transaction-actions">
                            <button class="delete-btn" onclick="deleteTransaction(${transaction.id})" title="Delete transaction">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Update category options based on selected type
        function updateCategoryOptions() {
            const select = document.getElementById('transactionCategory');
            const filteredCategories = allCategories.filter(cat => cat.type === selectedType);
            
            select.innerHTML = '<option value="">Select category...</option>' +
                filteredCategories.map(cat => 
                    `<option value="${cat.id}">${cat.name}</option>`
                ).join('');
        }

        // Update statistics
        function updateStats() {
            const totalCount = allTransactions.length;
            const incomeTotal = allTransactions
                .filter(t => t.type === 'income')
                .reduce((sum, t) => sum + parseFloat(t.amount), 0);
            const expenseTotal = allTransactions
                .filter(t => t.type === 'expense')
                .reduce((sum, t) => sum + parseFloat(t.amount), 0);
            const balance = incomeTotal - expenseTotal;

            document.getElementById('totalTransactions').textContent = totalCount;
            document.getElementById('totalIncome').textContent = `Rp ${incomeTotal.toLocaleString('id-ID')}`;
            document.getElementById('totalExpense').textContent = `Rp ${expenseTotal.toLocaleString('id-ID')}`;
            document.getElementById('netBalance').textContent = `Rp ${balance.toLocaleString('id-ID')}`;
        }

        // Update quick stats
        function updateQuickStats(summary) {
            const content = document.getElementById('quickStatsContent');
            const thisMonthTransactions = allTransactions.filter(t => {
                const transactionDate = new Date(t.transaction_date);
                const now = new Date();
                return transactionDate.getMonth() === now.getMonth() && 
                       transactionDate.getFullYear() === now.getFullYear();
            });

            const avgPerDay = thisMonthTransactions.length > 0 ? 
                (summary.total_income - summary.total_expense) / new Date().getDate() : 0;

            content.innerHTML = `
                <div class="quick-stat-item">
                    <span class="quick-stat-label">Total Income</span>
                    <span class="quick-stat-value income">Rp ${summary.total_income.toLocaleString('id-ID')}</span>
                </div>
                <div class="quick-stat-item">
                    <span class="quick-stat-label">Total Expenses</span>
                    <span class="quick-stat-value expense">Rp ${summary.total_expense.toLocaleString('id-ID')}</span>
                </div>
                <div class="quick-stat-item">
                    <span class="quick-stat-label">Transactions</span>
                    <span class="quick-stat-value">${thisMonthTransactions.length}</span>
                </div>
                <div class="quick-stat-item">
                    <span class="quick-stat-label">Average per day</span>
                    <span class="quick-stat-value">Rp ${Math.abs(avgPerDay).toLocaleString('id-ID')}</span>
                </div>
            `;
        }

        // Select transaction type
        function selectType(type) {
            selectedType = type;
            document.querySelectorAll('.type-option').forEach(option => {
                option.classList.remove('selected', 'income', 'expense');
            });
            event.target.classList.add('selected', type);
            updateCategoryOptions();
        }

        // Filter transactions
        function filterTransactions(type) {
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter and display
            if (type === 'all') {
                displayTransactions(allTransactions);
            } else {
                const filtered = allTransactions.filter(t => t.type === type);
                displayTransactions(filtered);
            }
        }

        // Search transactions
        function searchTransactions(query) {
            if (!query.trim()) {
                displayTransactions(allTransactions);
                return;
            }

            const filtered = allTransactions.filter(transaction => {
                const description = transaction.description.toLowerCase();
                const category = (transaction.category?.name || '').toLowerCase();
                const searchTerm = query.toLowerCase();
                
                return description.includes(searchTerm) || category.includes(searchTerm);
            });

            displayTransactions(filtered);
        }

        // Add new transaction
        async function addTransaction() {
            const description = document.getElementById('transactionDescription').value.trim();
            const amount = document.getElementById('transactionAmount').value;
            const categoryId = document.getElementById('transactionCategory').value;
            const date = document.getElementById('transactionDate').value;

            // Validation
            if (!description || !amount || !categoryId || !date) {
                showMessage('Please fill in all fields', 'error');
                return;
            }

            if (parseFloat(amount) <= 0) {
                showMessage('Amount must be greater than 0', 'error');
                return;
            }

            const addBtn = document.getElementById('addBtn');
            addBtn.disabled = true;
            addBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

            try {
                const response = await apiRequest('/transactions', {
                    method: 'POST',
                    body: JSON.stringify({
                        description: description,
                        amount: parseFloat(amount),
                        category_id: parseInt(categoryId),
                        transaction_date: date,
                        type: selectedType
                    })
                });

                showMessage('Transaction added successfully!', 'success');
                clearForm();
                await loadTransactions();
                await loadSummary();
            } catch (error) {
                console.error('Error adding transaction:', error);
                showMessage(error.message || 'Failed to add transaction', 'error');
            } finally {
                addBtn.disabled = false;
                addBtn.innerHTML = '<i class="fas fa-plus"></i> Add Transaction';
            }
        }

        // Delete transaction
        async function deleteTransaction(id) {
            if (!confirm('Are you sure you want to delete this transaction?')) {
                return;
            }

            try {
                await apiRequest(`/transactions/${id}`, {
                    method: 'DELETE'
                });

                showMessage('Transaction deleted successfully!', 'success');
                await loadTransactions();
                await loadSummary();
            } catch (error) {
                console.error('Error deleting transaction:', error);
                showMessage(error.message || 'Failed to delete transaction', 'error');
            }
        }

        // Clear form
        function clearForm() {
            document.getElementById('transactionDescription').value = '';
            document.getElementById('transactionAmount').value = '';
            document.getElementById('transactionCategory').value = '';
            document.getElementById('transactionDate').valueAsDate = new Date();
            clearMessages();
        }

        // Show message
        function showMessage(message, type) {
            const messageDiv = document.getElementById('formMessage');
            messageDiv.innerHTML = `<div class="${type}-message">${message}</div>`;
            
            setTimeout(() => {
                clearMessages();
            }, 5000);
        }

        // Clear messages
        function clearMessages() {
            document.getElementById('formMessage').innerHTML = '';
            document.getElementById('transactionsMessage').innerHTML = '';
        }

        // Set default date
        function setDefaultDate() {
            document.getElementById('transactionDate').valueAsDate = new Date();
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', init);
    </script>
</body>
</html>