@extends('admin.layout.master')

@section('content')
<style>
    /* Dashboard Specific Styles */
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #f5f5f5;
        min-height: 100vh;
        transition: margin-left 0.3s ease;
    }

    /* Top Navigation Bar */
    .top-navbar {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .search-container {
        flex: 0 0 300px;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #e0e0e0;
        border-radius: 25px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #004271;
        box-shadow: 0 0 0 3px rgba(0, 66, 113, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .task-dropdown {
        padding: 0.75rem 1.5rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .task-dropdown:hover {
        border-color: #004271;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-left: auto;
    }

    .btn-main-account {
        background: #004271;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-main-account:hover {
        background: #003159;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 66, 113, 0.3);
    }

    .icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f5f5f5;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .icon-btn:hover {
        background: #e0e0e0;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Quick Access Buttons */
    .quick-access-section {
        padding: 1.5rem 2rem;
        background: white;
        margin: 1rem 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .quick-access-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .quick-btn {
        padding: 0.75rem 1.25rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        cursor: pointer;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .quick-btn:hover {
        border-color: #004271;
        background: #f8f9fa;
        transform: translateY(-2px);
    }

    .quick-btn i {
        font-size: 1rem;
    }

    .date-range-badge {
        padding: 0.75rem 1.25rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        font-size: 0.85rem;
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Stats Cards */
    .stats-section {
        padding: 0 2rem;
        margin-bottom: 1.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
    }

    .stat-card {
        background: white;
        padding: 1.25rem 1.5rem;
        border-radius: 12px;
        border: 2px solid;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .stat-card.blue { border-color: #4A90E2; }
    .stat-card.green { border-color: #50C878; }
    .stat-card.yellow { border-color: #FFD700; }
    .stat-card.red { border-color: #DC143C; }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .stat-card.blue .stat-icon { 
        background: transparent;
        color: #4A90E2; 
    }
    .stat-card.green .stat-icon { 
        background: transparent;
        color: #50C878; 
    }
    .stat-card.yellow .stat-icon { 
        background: transparent;
        color: #FFD700; 
    }
    .stat-card.red .stat-icon { 
        background: transparent;
        color: #DC143C; 
    }

    .stat-content {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #1a1a1a;
        font-weight: 500;
        line-height: 1.2;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1;
    }

    /* Financial Cards */
    .financial-cards {
        padding: 0 2rem;
        margin-bottom: 1.5rem;
    }

    .financial-grid {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .financial-card {
        padding: 1.5rem 1.75rem;
        border-radius: 12px;
        color: #000000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
        min-width: 220px;
    }

    .financial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .financial-card.blue { 
        background: linear-gradient(135deg, #6B9FE8 0%, #7BA8EC 100%); 
    }
    .financial-card.green { 
        background: linear-gradient(135deg, #6FD89C 0%, #7EE0A8 100%); 
    }
    .financial-card.pink { 
        background: linear-gradient(135deg, #F5A6B8 0%, #F8B5C5 100%); 
    }
    .financial-card.yellow { 
        background: linear-gradient(135deg, #F5D77E 0%, #F8DD8E 100%); 
    }

    .financial-icon {
        font-size: 2.5rem;
        opacity: 0.95;
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .financial-content {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        color: #000000;
    }

    .financial-label {
        font-size: 0.95rem;
        opacity: 0.95;
        font-weight: 500;
        line-height: 1.2;
        color: #000000;
    }

    .financial-value {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.2;
        color: #000000;
    }

    /* Charts Section */
    .charts-section {
        padding: 0 2rem;
        margin-bottom: 2rem;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .chart-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .chart-card.expense-card {
        background: #E8E8F0;
        padding: 2rem;
    }

    .chart-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #000000;
        margin-bottom: 1.5rem;
    }

    .chart-container {
        height: 350px;
        position: relative;
    }

    /* Expense Breakdown */
    .expense-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .expense-item {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .expense-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .expense-value {
        font-size: 1.25rem;
        font-weight: 600;
        color: #000000;
        margin-bottom: 0.5rem;
    }

    .expense-label {
        font-size: 1rem;
        color: #004271;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Mobile responsive styles */
    @media (max-width: 767px) {
        .dashboard-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .top-navbar {
            flex-direction: column;
            align-items: stretch;
            padding: 1rem;
            gap: 1rem;
        }

        .search-container {
            order: 1;
            flex: 1 1 100%;
        }

        .task-dropdown {
            order: 2;
            width: 100%;
        }

        .nav-actions {
            order: 3;
            justify-content: space-between;
            width: 100%;
        }

        .btn-main-account {
            padding: 0.75rem;
            font-size: 0.85rem;
        }

        .quick-access-section {
            padding: 1rem;
            margin: 0.5rem 1rem;
        }

        .quick-access-buttons {
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .quick-btn {
            flex: 0 0 auto;
            white-space: nowrap;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .financial-grid {
            flex-direction: column;
        }

        .financial-card {
            min-width: 100%;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }

        .expense-list {
            grid-template-columns: 1fr;
        }

        .date-range-badge {
            margin-left: 0;
            margin-top: 0.5rem;
        }

        .stat-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .stat-content {
            width: 100%;
        }
    }

    /* iPad responsive styles */
    @media (min-width: 768px) and (max-width: 992px) {
        .dashboard-wrapper {
            margin-left: 70px !important;
        }

        .top-navbar {
            flex-wrap: wrap;
            padding: 1rem 1.5rem;
        }

        .search-container {
            flex: 1 1 200px;
        }

        .quick-access-buttons {
            flex-wrap: wrap;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .financial-grid {
            flex-wrap: wrap;
        }

        .financial-card {
            min-width: 200px;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }

        .expense-list {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* iPad Pro/Large Tablet */
    @media (min-width: 993px) and (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .financial-grid {
            flex-wrap: wrap;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrapper">
    <!-- Top Navigation Bar -->
    <div class="top-navbar">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search..">
        </div>
        
        <select class="task-dropdown">
            <option>Task</option>
            <option>All Tasks</option>
            <option>Pending Tasks</option>
            <option>Completed Tasks</option>
        </select>

        <div class="nav-actions">
            <button class="btn-main-account">Go To Main Account</button>
            <button class="icon-btn">
                <i class="fas fa-cog"></i>
            </button>
            <button class="icon-btn">
                <i class="fas fa-power-off"></i>
            </button>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="quick-access-section">
        <div class="quick-access-buttons">
            <button class="quick-btn">
                <i class="fas fa-clipboard-list"></i>
                Ops Board
            </button>
            <button class="quick-btn">
                <i class="fas fa-chart-line"></i>
                Finance
            </button>
            <button class="quick-btn">
                <i class="fas fa-clipboard-check"></i>
                Duties
            </button>
            <button class="quick-btn">
                <i class="fas fa-user-check"></i>
                Attendance
            </button>
            <button class="quick-btn">
                <i class="fas fa-map-marker-alt"></i>
                Tracking
            </button>
            <button class="quick-btn">
                <i class="fas fa-bell"></i>
                Reminders
            </button>
            <button class="quick-btn">
                <i class="fas fa-tools"></i>
                Maintenance
            </button>
            <button class="quick-btn">
                <i class="fas fa-file-invoice"></i>
                Invoice
            </button>
            <div class="date-range-badge">
                <i class="fas fa-calendar"></i>
                02/12/2025 - 04/12/2025
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="far fa-user"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Drivers</div>
                    <div class="stat-value">1</div>
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Vehicles</div>
                    <div class="stat-value">1</div>
                </div>
            </div>

            <div class="stat-card yellow">
                <div class="stat-icon">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Active Duties</div>
                    <div class="stat-value">2</div>
                </div>
            </div>

            <div class="stat-card red">
                <div class="stat-icon">
                    <i class="far fa-bell"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Critical Alerts</div>
                    <div class="stat-value">0</div>
                </div>
            </div>

            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="far fa-chart-bar"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">AVG Expense/Trip</div>
                    <div class="stat-value">0</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Cards -->
    <div class="financial-cards">
        <div class="financial-grid">
            <div class="financial-card blue">
                <div class="financial-icon">
                    <i class="far fa-credit-card"></i>
                </div>
                <div class="financial-content">
                    <div class="financial-label">Net Income</div>
                    <div class="financial-value">₹ - 1000.0 /-</div>
                </div>
            </div>

            <div class="financial-card green">
                <div class="financial-icon">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div class="financial-content">
                    <div class="financial-label">Total Earnings</div>
                    <div class="financial-value">₹ - 1000.0 /-</div>
                </div>
            </div>

            <div class="financial-card pink">
                <div class="financial-icon">
                    <i class="far fa-credit-card"></i>
                </div>
                <div class="financial-content">
                    <div class="financial-label">Total Expenses</div>
                    <div class="financial-value">₹ - 1000.0 /-</div>
                </div>
            </div>

            <div class="financial-card yellow">
                <div class="financial-icon">
                    <i class="fas fa-search-dollar"></i>
                </div>
                <div class="financial-content">
                    <div class="financial-label">Net Income</div>
                    <div class="financial-value">₹ - 1000.0 /-</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <div class="charts-grid">
            <!-- Daily Financials Chart -->
            <div class="chart-card">
                <h3 class="chart-title">Daily Financials</h3>
                <div class="chart-container">
                    <canvas id="financialsChart"></canvas>
                </div>
            </div>

            <!-- Expense Breakdown -->
            <div class="chart-card expense-card">
                <h3 class="chart-title">Expense Breakdown</h3>
                <div class="expense-list">
                    <div class="expense-item">
                        <div class="expense-value">₹ 0.00</div>
                        <div class="expense-label">Fuel</div>
                    </div>
                    <div class="expense-item">
                        <div class="expense-value">₹ 0.00</div>
                        <div class="expense-label">Food</div>
                    </div>
                    <div class="expense-item">
                        <div class="expense-value">₹ 0.00</div>
                        <div class="expense-label">Toll</div>
                    </div>
                    <div class="expense-item">
                        <div class="expense-value">₹ 0.00</div>
                        <div class="expense-label">Parking</div>
                    </div>
                    <div class="expense-item">
                        <div class="expense-value">₹ 0.00</div>
                        <div class="expense-label">Maintenance</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    // Sidebar toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('expanded');
                sidebar.classList.toggle('collapsed');
                
                const icon = this.querySelector('i');
                const text = this.querySelector('.toggle-text');
                
                if (sidebar.classList.contains('expanded')) {
                    icon.classList.remove('fa-chevron-right');
                    icon.classList.add('fa-chevron-left');
                    text.textContent = 'Collapse';
                } else {
                    icon.classList.remove('fa-chevron-left');
                    icon.classList.add('fa-chevron-right');
                    text.textContent = 'Expand';
                }
            });
        }

        // Daily Financials Chart
        const ctx = document.getElementById('financialsChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['2017', '2018', '2019', '2020'],
                    datasets: [{
                        label: 'Income',
                        data: [46000, 37000, 38000, 50000],
                        backgroundColor: '#4A90E2',
                        borderRadius: 8,
                        barThickness: 40
                    }, {
                        label: 'Expense',
                        data: [22000, 22000, 24000, 18000],
                        backgroundColor: '#f5576c',
                        borderRadius: 8,
                        barThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        title: {
                            display: true,
                            text: 'Income & Expense comparison over years',
                            font: {
                                size: 12,
                                weight: 'normal'
                            },
                            color: '#666',
                            padding: {
                                bottom: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₹' + (value/1000) + 'K';
                                }
                            },
                            grid: {
                                display: true,
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    });
</script>

@endsection
