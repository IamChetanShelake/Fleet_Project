@extends('admin.layout.master')

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<style>
    /* Dashboard Specific Styles */
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #E5EAF2;
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
        background: rgba(0, 66, 113, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 66, 113, 0.15);
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

    .stat-card.blue:hover {
        background: rgba(74, 144, 226, 0.1);
    }

    .stat-card.green:hover {
        background: rgba(80, 200, 120, 0.1);
    }

    .stat-card.yellow:hover {
        background: rgba(255, 215, 0, 0.1);
    }

    .stat-card.red:hover {
        background: rgba(220, 20, 60, 0.1);
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

    /* Map Section */
    .map-section {
        padding: 0 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .map-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        position: relative;
        height: 500px;
        z-index: 2;
    }

    /* Leaflet map controls */
    .leaflet-control-container {
        z-index: 3 !important;
    }

    .leaflet-top,
    .leaflet-bottom {
        z-index: 3 !important;
    }

    .leaflet-control-zoom {
        z-index: 3 !important;
    }

    .leaflet-control-fullscreen {
        z-index: 3 !important;
    }

    .leaflet-control-layers {
        z-index: 3 !important;
    }

    .leaflet-control-scale {
        z-index: 3 !important;
    }

    .map-legend {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        background: white;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    /* Vehicle markers */
    .vehicle-marker {
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.8rem;
        cursor: pointer;
        z-index: 4 !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    /* Leaflet popup */
    .leaflet-popup {
        z-index: 1001 !important;
    }

    .leaflet-popup-content-wrapper {
        border-radius: 8px !important;
    }

    .leaflet-popup-tip {
        background: white !important;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
    }

    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 3px;
    }

    /* Vehicle Status Cards - Pill Shape Format */
    .vehicle-status-section {
        padding: 0 2rem 2rem 2rem;
        margin-bottom: 2rem;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .status-card {
        padding: 1rem 1.5rem;
        border-radius: 8px; /* Rectangular shape */
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        min-width: 180px;
        justify-content: flex-start;
    }

    .status-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .status-card.all {
        background: #81C784;
        color: white;
    }

    .status-card.running {
        background: #64B5F6;
        color: white;
    }

    .status-card.halt {
        background: #F06292;
        color: white;
    }

    .status-card.idle {
        background: #4DD0E1;
        color: white;
    }

    .status-card.inactive {
        background: #FFD54F;
        color: #333;
    }

    .status-card.nodata {
        background: #B0BEC5;
        color: white;
    }

    .status-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .status-content {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-grow: 1;
    }

    .status-label {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .status-value {
        font-size: 1.2rem;
        font-weight: 700;
        margin-left: auto;
    }

    /* Vehicle marker styles */
    .vehicle-marker {
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.8rem;
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .vehicle-marker.blue {
        background: #2196F3;
    }

    .vehicle-marker.orange {
        background: #FF9800;
    }

    /* Additional responsive styles for new sections */
    @media (max-width: 1200px) {
        .status-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767px) {
        .map-container {
            height: 350px;
        }

        .status-grid {
            grid-template-columns: 1fr;
        }

        .status-card {
            flex-direction: column;
            text-align: center;
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
    <!-- <div class="top-navbar">
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
    </div> -->

    <!-- Quick Access Buttons -->
    <div class="quick-access-section">
        <div class="quick-access-buttons">
            
            <button class="quick-btn">
                <i class="fas fa-chart-line"></i>
                Finance
            </button>
            <button class="quick-btn">
                <i class="fas fa-clipboard-check"></i>
                Duties
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

    <!-- Map Section -->
    <div class="map-section">
        <div class="map-container">
            <div id="map" style="width: 100%; height: 100%;"></div>

            <!-- Map legend -->
            <div class="map-legend">
                <div class="legend-item">
                    <div class="legend-color" style="background: #2196F3;"></div>
                    <span>Running Vehicle</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #FF9800;"></div>
                    <span>Alert Vehicle</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #4CAF50;"></div>
                    <span>Highway</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #2196F3; border-radius: 50%;"></div>
                    <span>Toll Plaza</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicle Status Cards -->
    <div class="vehicle-status-section">
        <div class="status-grid">
            <div class="status-card all">
                <div class="status-icon">
                    <img src="{{ asset('images/f7_creditcard.png') }}" alt="All" style="width: 20px; height: 20px;">
                </div>
                <div class="status-content">
                    <div class="status-label">All</div>
                    <div class="status-value">4</div>
                </div>
            </div>

            <div class="status-card running">
                <div class="status-icon">
                    <img src="{{ asset('images/streamline-plump_wallet.png') }}" alt="Running" style="width: 20px; height: 20px;">
                </div>
                <div class="status-content">
                    <div class="status-label">Running</div>
                    <div class="status-value">4</div>
                </div>
            </div>

            <div class="status-card halt">
                <div class="status-icon">
                    <img src="{{ asset('images/streamline-ultimate_currency-sign-rupee-decrease.png') }}" alt="On Halt" style="width: 20px; height: 20px;">
                </div>
                <div class="status-content">
                    <div class="status-label">On Halt</div>
                    <div class="status-value">1</div>
                </div>
            </div>

            <div class="status-card idle">
                <div class="status-icon">
                    <img src="{{ asset('images/token_idle.png') }}" alt="Idle" style="width: 20px; height: 20px;">
                </div>
                <div class="status-content">
                    <div class="status-label">Idle</div>
                    <div class="status-value">0</div>
                </div>
            </div>

            <div class="status-card inactive">
                <div class="status-icon">
                    <img src="{{ asset('images/material-symbols_airplanemode-inactive.png') }}" alt="Inactive" style="width: 20px; height: 20px;">
                </div>
                <div class="status-content">
                    <div class="status-label">Inactive</div>
                    <div class="status-value">1</div>
                </div>
            </div>

            <div class="status-card nodata">
                <div class="status-icon">
                    <img src="{{ asset('images/material-symbols_signal-cellular-nodata-outline.png') }}" alt="No Data" style="width: 20px; height: 20px;">
                </div>
                <div class="status-content">
                    <div class="status-label">No Data</div>
                    <div class="status-value">0</div>
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

        // Initialize Leaflet Map
        const map = L.map('map').setView([23.0, 78.0], 5); // Centered on India with appropriate zoom level

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Add scale control
        L.control.scale().addTo(map);

        // Add fullscreen control
        L.control.fullscreen().addTo(map);

        // Create custom icons
        const runningIcon = L.divIcon({
            html: '<div style="background: #4CAF50; width: 24px; height: 24px; border-radius: 50%; border: 2px solid white; display: flex; align-items: center; justify-content: center;"><i class="fas fa-truck" style="color: white; font-size: 12px;"></i></div>',
            className: 'vehicle-marker-icon',
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });

        const alertIcon = L.divIcon({
            html: '<div style="background: #FF9800; width: 24px; height: 24px; border-radius: 50%; border: 2px solid white; display: flex; align-items: center; justify-content: center;"><i class="fas fa-exclamation-triangle" style="color: white; font-size: 12px;"></i></div>',
            className: 'vehicle-marker-icon',
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });

        const tollIcon = L.divIcon({
            html: '<div style="background: #2196F3; width: 16px; height: 16px; border-radius: 50%; border: 2px solid white;"></div>',
            className: 'toll-marker-icon',
            iconSize: [16, 16],
            iconAnchor: [8, 8]
        });

        const highwayIcon = L.divIcon({
            html: '<div style="width: 20px; height: 4px; background: #4CAF50; border-radius: 2px;"></div>',
            className: 'highway-marker-icon',
            iconSize: [20, 4],
            iconAnchor: [10, 2]
        });

        // Sample vehicle locations
        const vehicles = [
            { lat: 28.6139, lng: 77.2090, status: 'running', name: 'Truck DEL-001' }, // Delhi
            { lat: 19.0760, lng: 72.8777, status: 'running', name: 'Truck MUM-002' }, // Mumbai
            { lat: 13.0827, lng: 80.2707, status: 'alert', name: 'Truck CHE-003' }, // Chennai
            { lat: 22.5726, lng: 88.3639, status: 'running', name: 'Truck KOL-004' }, // Kolkata
            { lat: 12.9716, lng: 77.5946, status: 'running', name: 'Truck BAN-005' }, // Bangalore
            { lat: 23.0225, lng: 72.5714, status: 'running', name: 'Truck AHM-006' }, // Ahmedabad
            { lat: 21.1702, lng: 72.8311, status: 'alert', name: 'Truck SUR-007' } // Surat
        ];

        // Add vehicle markers
        vehicles.forEach(vehicle => {
            const icon = vehicle.status === 'alert' ? alertIcon : runningIcon;
            const marker = L.marker([vehicle.lat, vehicle.lng], { icon: icon }).addTo(map);

            marker.bindPopup(`
                <div style="font-family: Arial, sans-serif; max-width: 200px;">
                    <h4 style="margin: 0 0 8px 0; color: #004271;">${vehicle.name}</h4>
                    <p style="margin: 4px 0;"><strong>Status:</strong> ${vehicle.status === 'alert' ? 'Alert' : 'Running'}</p>
                    <p style="margin: 4px 0;"><strong>Location:</strong> ${vehicle.lat.toFixed(4)}, ${vehicle.lng.toFixed(4)}</p>
                    <p style="margin: 4px 0;"><strong>Last Update:</strong> ${new Date().toLocaleString()}</p>
                </div>
            `);
        });

        // Add highway markers (green lines) - these represent major highways
        const highways = [
            // North-South Corridor
            [[28.6139, 77.2090], [26.8467, 80.9462], [25.4358, 81.8463], [23.0225, 72.5714]], // Delhi to Ahmedabad
            [[26.8467, 80.9462], [25.3176, 82.9739], [24.8399, 85.3400], [23.2599, 77.4126]], // Lucknow to Bhopal
            [[23.0225, 72.5714], [19.0760, 72.8777]], // Ahmedabad to Mumbai
            [[19.0760, 72.8777], [18.5204, 73.8567], [12.9716, 77.5946]], // Mumbai to Bangalore

            // East-West Corridor
            [[22.5726, 88.3639], [23.3441, 85.3096], [25.5941, 85.1376], [26.8467, 80.9462]], // Kolkata to Lucknow
            [[23.0225, 72.5714], [23.2599, 77.4126], [22.7196, 75.8577], [21.1702, 72.8311]], // Ahmedabad to Surat
            [[12.9716, 77.5946], [13.0827, 80.2707]] // Bangalore to Chennai
        ];

        highways.forEach(highway => {
            L.polyline(highway, {
                color: '#4CAF50',
                weight: 4,
                opacity: 0.8
            }).addTo(map);
        });

        // Add toll plaza markers (blue circles)
        const tollPlazas = [
            // North India
            { lat: 28.4267, lng: 77.0856, name: 'Delhi Toll Plaza' }, // Near Delhi
            { lat: 26.8765, lng: 80.9123, name: 'Lucknow Toll Plaza' },
            { lat: 25.4500, lng: 81.8500, name: 'Allahabad Toll Plaza' },
            { lat: 23.1815, lng: 72.6369, name: 'Ahmedabad Toll Plaza' },

            // West India
            { lat: 19.1500, lng: 72.8500, name: 'Mumbai Toll Plaza' },
            { lat: 18.5500, lng: 73.8500, name: 'Pune Toll Plaza' },
            { lat: 21.1500, lng: 72.8000, name: 'Surat Toll Plaza' },

            // South India
            { lat: 12.9500, lng: 77.5500, name: 'Bangalore Toll Plaza' },
            { lat: 13.0500, lng: 80.2500, name: 'Chennai Toll Plaza' },

            // East India
            { lat: 22.6500, lng: 88.4000, name: 'Kolkata Toll Plaza' },
            { lat: 23.3500, lng: 85.3000, name: 'Ranchi Toll Plaza' },

            // Central India
            { lat: 23.2500, lng: 77.4000, name: 'Bhopal Toll Plaza' },
            { lat: 21.1500, lng: 79.0833, name: 'Nagpur Toll Plaza' }
        ];

        tollPlazas.forEach(toll => {
            L.marker([toll.lat, toll.lng], { icon: tollIcon }).addTo(map)
                .bindPopup(`
                    <div style="font-family: Arial, sans-serif; max-width: 200px;">
                        <h4 style="margin: 0 0 8px 0; color: #004271;">${toll.name}</h4>
                        <p style="margin: 4px 0;"><strong>Type:</strong> Toll Plaza</p>
                        <p style="margin: 4px 0;"><strong>Location:</strong> ${toll.lat.toFixed(4)}, ${toll.lng.toFixed(4)}</p>
                    </div>
                `);
        });

        // Add other points of interest (cities, national parks, etc.)
        const pointsOfInterest = [
            // Major Cities
            { lat: 28.6139, lng: 77.2090, name: 'New Delhi', type: 'capital' },
            { lat: 19.0760, lng: 72.8777, name: 'Mumbai', type: 'city' },
            { lat: 13.0827, lng: 80.2707, name: 'Chennai', type: 'city' },
            { lat: 22.5726, lng: 88.3639, name: 'Kolkata', type: 'city' },
            { lat: 12.9716, lng: 77.5946, name: 'Bangalore', type: 'city' },
            { lat: 23.0225, lng: 72.5714, name: 'Ahmedabad', type: 'city' },
            { lat: 21.1702, lng: 72.8311, name: 'Surat', type: 'city' },
            { lat: 26.8467, lng: 80.9462, name: 'Lucknow', type: 'city' },
            { lat: 25.5941, lng: 85.1376, name: 'Patna', type: 'city' },
            { lat: 23.2599, lng: 77.4126, name: 'Bhopal', type: 'city' },
            { lat: 22.7196, lng: 75.8577, name: 'Indore', type: 'city' },
            { lat: 21.1500, lng: 79.0833, name: 'Nagpur', type: 'city' },
            { lat: 18.5204, lng: 73.8567, name: 'Pune', type: 'city' },
            { lat: 17.3850, lng: 78.4867, name: 'Hyderabad', type: 'city' },
            { lat: 28.7041, lng: 77.1025, name: 'Gurgaon', type: 'city' },
            { lat: 28.4595, lng: 77.0266, name: 'Noida', type: 'city' },

            // National Parks and Wildlife Sanctuaries
            { lat: 25.3176, lng: 82.9739, name: 'Kuno National Park', type: 'park' },
            { lat: 24.0452, lng: 83.2681, name: 'Palamau Tiger Reserve', type: 'park' },
            { lat: 23.6756, lng: 85.2793, name: 'Hazaribagh Wildlife Sanctuary', type: 'park' },
            { lat: 21.1644, lng: 79.3230, name: 'Pench National Park', type: 'park' },
            { lat: 21.2500, lng: 81.6296, name: 'Indravati National Park', type: 'park' },
            { lat: 19.9615, lng: 79.3025, name: 'Tadoba Andhari Tiger Reserve', type: 'park' },
            { lat: 17.1899, lng: 79.9000, name: 'Nagarjunsagar-Srisailam Tiger Reserve', type: 'park' },
            { lat: 11.6670, lng: 76.7000, name: 'Mudumalai National Park', type: 'park' },
            { lat: 11.5000, lng: 76.5000, name: 'Bandipur National Park', type: 'park' },
            { lat: 20.1627, lng: 85.8312, name: 'Bhitarkanika National Park', type: 'park' },
            { lat: 27.5833, lng: 77.3333, name: 'Keoladeo National Park', type: 'park' },

            // Other Points of Interest
            { lat: 25.3100, lng: 82.9800, name: 'Varanasi', type: 'heritage' },
            { lat: 27.1767, lng: 78.0081, name: 'Agra (Taj Mahal)', type: 'heritage' },
            { lat: 26.9124, lng: 75.7873, name: 'Jaipur', type: 'heritage' },
            { lat: 15.3333, lng: 76.4667, name: 'Hampi', type: 'heritage' },
            { lat: 10.7833, lng: 78.7000, name: 'Trichy', type: 'heritage' },
            { lat: 13.0524, lng: 77.5946, name: 'Electronic City', type: 'industrial' },
            { lat: 18.5500, lng: 73.9500, name: 'Magarpatta City', type: 'industrial' }
        ];

        // Create icons for different types of points
        const cityIcon = L.divIcon({
            html: '<i class="fas fa-city" style="color: #666; font-size: 16px;"></i>',
            iconSize: [25, 25],
            iconAnchor: [12, 12]
        });

        const parkIcon = L.divIcon({
            html: '<i class="fas fa-tree" style="color: #2E7D32; font-size: 16px;"></i>',
            iconSize: [25, 25],
            iconAnchor: [12, 12]
        });

        const heritageIcon = L.divIcon({
            html: '<i class="fas fa-landmark" style="color: #795548; font-size: 16px;"></i>',
            iconSize: [25, 25],
            iconAnchor: [12, 12]
        });

        const industrialIcon = L.divIcon({
            html: '<i class="fas fa-industry" style="color: #607D8B; font-size: 16px;"></i>',
            iconSize: [25, 25],
            iconAnchor: [12, 12]
        });

        // Add points of interest to the map
        pointsOfInterest.forEach(point => {
            let icon;
            switch(point.type) {
                case 'capital':
                    icon = L.divIcon({
                        html: '<i class="fas fa-star" style="color: #FFD700; font-size: 18px;"></i>',
                        iconSize: [25, 25],
                        iconAnchor: [12, 12]
                    });
                    break;
                case 'city':
                    icon = cityIcon;
                    break;
                case 'park':
                    icon = parkIcon;
                    break;
                case 'heritage':
                    icon = heritageIcon;
                    break;
                case 'industrial':
                    icon = industrialIcon;
                    break;
            }

            L.marker([point.lat, point.lng], { icon: icon }).addTo(map)
                .bindPopup(`
                    <div style="font-family: Arial, sans-serif; max-width: 200px;">
                        <h4 style="margin: 0 0 8px 0; color: #004271;">${point.name}</h4>
                        <p style="margin: 4px 0;"><strong>Type:</strong> ${point.type}</p>
                        <p style="margin: 4px 0;"><strong>Location:</strong> ${point.lat.toFixed(4)}, ${point.lng.toFixed(4)}</p>
                    </div>
                `);
        });

        // Fit map to show all markers
        const allMarkers = [
            ...vehicles.map(v => L.marker([v.lat, v.lng])),
            ...tollPlazas.map(t => L.marker([t.lat, t.lng], { icon: tollIcon })),
            ...pointsOfInterest.map(p => {
                let icon;
                switch(p.type) {
                    case 'capital':
                        icon = L.divIcon({
                            html: '<i class="fas fa-star" style="color: #FFD700; font-size: 18px;"></i>',
                            iconSize: [25, 25]
                        });
                        break;
                    case 'city':
                        icon = cityIcon;
                        break;
                    case 'park':
                        icon = parkIcon;
                        break;
                    case 'heritage':
                        icon = heritageIcon;
                        break;
                    case 'industrial':
                        icon = industrialIcon;
                        break;
                }
                return L.marker([p.lat, p.lng], { icon: icon });
            })
        ];

        const group = new L.featureGroup(allMarkers);
        map.fitBounds(group.getBounds().pad(0.2));

        // Vehicle status card click handlers
        const statusCards = document.querySelectorAll('.status-card');
        statusCards.forEach(card => {
            card.addEventListener('click', function() {
                const status = this.classList.contains('all') ? 'all' :
                              this.classList.contains('running') ? 'running' :
                              this.classList.contains('halt') ? 'halt' :
                              this.classList.contains('idle') ? 'idle' :
                              this.classList.contains('inactive') ? 'inactive' : 'nodata';

                console.log(`Filtering vehicles by status: ${status}`);
                // Add your filtering logic here
            });
        });
    });
</script>

@endsection
