@extends('admin.layout.master')

@section('content')
<!-- Google Maps API -->
<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async&libraries=places"></script>

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

    .dashboard-map {
        width: 100%;
        height: 100%;
        border-radius: 12px;
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

    .legend-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
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

    .legend-marker {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: white;
    }

    .map-controls {
        position: absolute;
        top: 4rem;
        right: 1rem;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .map-type-btn {
        padding: 8px 12px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .map-type-btn:hover,
    .map-type-btn.active {
        background: #317ff1;
        color: white;
        border-color: #317ff1;
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
            <div id="dashboard-map" class="dashboard-map"></div>
            
            <!-- Map Type Controls -->
            <div class="map-controls">
                <button class="map-type-btn active" data-map-type="roadmap" onclick="changeDashboardMapType('roadmap')">Roadmap</button>
                <button class="map-type-btn" data-map-type="satellite" onclick="changeDashboardMapType('satellite')">Satellite</button>
                <button class="map-type-btn" data-map-type="terrain" onclick="changeDashboardMapType('terrain')">Terrain</button>
                <button class="map-type-btn" data-map-type="hybrid" onclick="changeDashboardMapType('hybrid')">Hybrid</button>
            </div>

            <!-- Map legend -->
            <div class="map-legend">
                <div class="legend-title">Map Legend</div>
                <div class="legend-item">
                    <div class="legend-marker" style="background: #4CAF50;"><i class="fas fa-truck" style="font-size: 10px;"></i></div>
                    <span>Running Vehicle</span>
                </div>
                <div class="legend-item">
                    <div class="legend-marker" style="background: #2196F3;"><i class="fas fa-map-marker-alt" style="font-size: 10px;"></i></div>
                    <span>Trip Start</span>
                </div>
                <div class="legend-item">
                    <div class="legend-marker" style="background: #FF5722;"><i class="fas fa-map-marker-alt" style="font-size: 10px;"></i></div>
                    <span>Trip End</span>
                </div>
                <div class="legend-item">
                    <div class="legend-marker" style="background: #9C27B0;"><i class="fas fa-city" style="font-size: 10px;"></i></div>
                    <span>City</span>
                </div>
                <div class="legend-item">
                    <div class="legend-marker" style="background: #607D8B;"><i class="fas fa-industry" style="font-size: 10px;"></i></div>
                    <span>Industrial Area</span>
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
    // Dashboard Map Variables
    let dashboardMap = null;
    let dashboardMarkers = [];
    let dashboardPolylines = [];
    let dashboardInfoWindow = null;
    let tripDirectionsService = null;
    let tripDirectionsRenderer = null;

    // PHP data for ongoing transports
    const ongoingTransports = @json($ongoingTransports ?? []);
    console.log('Ongoing transports data:', ongoingTransports);

    // Initialize Dashboard Map
    function initDashboardMap() {
        // Check if Google Maps is loaded
        if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
            console.log('Google Maps not loaded yet, will retry...');
            setTimeout(initDashboardMap, 500);
            return;
        }
        
        if (dashboardMap) {
            return; // Map already initialized
        }
        
        const mapOptions = {
            zoom: 5,
            center: { lat: 24.0, lng: 47.0 }, // Centered on Saudi Arabia/Gulf region
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            fullscreenControl: true,
            mapTypeControl: false,
            streetViewControl: false,
            zoomControl: true
        };
        
        dashboardMap = new google.maps.Map(document.getElementById('dashboard-map'), mapOptions);
        dashboardInfoWindow = new google.maps.InfoWindow();
        tripDirectionsService = new google.maps.DirectionsService();
        tripDirectionsRenderer = new google.maps.DirectionsRenderer({
            map: dashboardMap,
            suppressMarkers: true,
            polylineOptions: {
                strokeColor: '#317ff1',
                strokeWeight: 4,
                strokeOpacity: 0.8
            }
        });
        
        // Add trip routes from ongoing transports
        addTripRoutes();
        
        // Add points of interest (cities, industrial areas)
        addPointsOfInterest();
        
        // Fit map to show all markers
        setTimeout(fitMapToMarkers, 2000);
        
        console.log('Dashboard map initialized successfully');
    }

    // Add trip routes for ongoing transports
    function addTripRoutes() {
        if (!ongoingTransports || ongoingTransports.length === 0) {
            console.log('No ongoing transports to display');
            // Add fallback vehicle markers when no transports
            addVehicleMarkers();
            return;
        }
        
        console.log('Adding ' + ongoingTransports.length + ' ongoing trips to map');
        
        ongoingTransports.forEach((transport, index) => {
            const pickupLocation = transport.pickup_location || transport.source_city;
            const deliveryLocation = transport.delivery_location || transport.dest_city;
            
            if (!pickupLocation || !deliveryLocation) {
                console.log('Skipping transport ' + transport.id + ': missing locations');
                return;
            }
            
            // Create unique color for each route
            const colors = ['#317ff1', '#33C17F', '#ED5A68', '#FF9800', '#9C27B0', '#00BCD4', '#795548'];
            const routeColor = colors[index % colors.length];
            
            // Add pickup marker
            addTripMarker(pickupLocation, 'start', transport, routeColor);
            
            // Add delivery marker
            addTripMarker(deliveryLocation, 'end', transport, routeColor);
            
            // Draw route between pickup and delivery
            drawTripRoute(pickupLocation, deliveryLocation, transport, routeColor);
        });
    }

    // Add a trip marker (start or end)
    function addTripMarker(location, type, transport, color) {
        const geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({ address: location }, function(results, status) {
            if (status === 'OK' && results[0]) {
                const position = results[0].geometry.location;
                const iconSymbol = type === 'start' ? '📦' : '📍';
                const iconColor = type === 'start' ? '#2196F3' : '#FF5722';
                const deliveryDate = transport.delivery_date ? 
                    new Date(transport.delivery_date).toLocaleDateString('en-GB', { 
                        day: '2-digit', month: 'short', year: 'numeric' 
                    }) : 'TBD';
                
                const marker = new google.maps.Marker({
                    position: position,
                    map: dashboardMap,
                    icon: {
                        url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">' +
                            '<circle cx="18" cy="18" r="16" fill="' + iconColor + '" stroke="white" stroke-width="2"/>' +
                            '<text x="18" y="23" text-anchor="middle" fill="white" font-size="14" font-weight="bold">' + iconSymbol + '</text>' +
                            '</svg>'
                        ),
                        scaledSize: new google.maps.Size(36, 36),
                        anchorPoint: new google.maps.Point(18, 18)
                    },
                    title: type === 'start' ? 'Pickup: ' + location : 'Delivery: ' + location,
                    animation: google.maps.Animation.DROP
                });
                
                dashboardMarkers.push(marker);
                
                const contentString = `
                    <div style="font-family: Arial, sans-serif; max-width: 280px; padding: 12px;">
                        <h4 style="margin: 0 0 10px 0; color: ${iconColor}; border-bottom: 2px solid ${iconColor}; padding-bottom: 8px;">
                            ${type === 'start' ? '📦 PICKUP' : '📍 DELIVERY'}
                        </h4>
                        <p style="margin: 6px 0;"><strong>Order No:</strong> ${transport.order_no || transport.id}</p>
                        <p style="margin: 6px 0;"><strong>Location:</strong> ${location}</p>
                        <p style="margin: 6px 0;"><strong>Consigner:</strong> ${transport.consigner || 'N/A'}</p>
                        <p style="margin: 6px 0;"><strong>Receiver:</strong> ${transport.receiver_name || 'N/A'}</p>
                        ${type === 'end' ? '<p style="margin: 6px 0; color: #FF5722; font-weight: bold;"><strong>Delivery Date:</strong> ' + deliveryDate + '</p>' : ''}
                        <p style="margin: 6px 0;"><strong>Status:</strong> <span style="color: #317ff1;">${transport.status || 'N/A'}</span></p>
                        <p style="margin: 10px 0 0 0;"><a href="/admin/consignment/${transport.id}" style="color: #317ff1;">View Details →</a></p>
                    </div>
                `;
                
                marker.addListener('click', () => {
                    dashboardInfoWindow.setContent(contentString);
                    dashboardInfoWindow.open(dashboardMap, marker);
                });
            } else {
                console.log('Geocoding failed for ' + location + ': ' + status);
            }
        });
    }

    // Draw route between pickup and delivery
    function drawTripRoute(origin, destination, transport, color) {
        const request = {
            origin: origin,
            destination: destination,
            travelMode: 'DRIVING',
            provideRouteAlternatives: true
        };
        
        tripDirectionsService.route(request, function(response, status) {
            if (status === 'OK') {
                // Create a colored polyline for this route
                const route = response.routes[0];
                const legs = route.legs[0];
                
                const routePolyline = new google.maps.Polyline({
                    path: route.overview_path,
                    geodesic: true,
                    strokeColor: color,
                    strokeWeight: 4,
                    strokeOpacity: 0.8,
                    map: dashboardMap
                });
                
                dashboardPolylines.push(routePolyline);
                
                // Add delivery date label at midpoint of route
                const midpointIndex = Math.floor(route.overview_path.length / 2);
                const midpoint = route.overview_path[midpointIndex];
                
                if (midpoint && transport.delivery_date) {
                    const deliveryDate = new Date(transport.delivery_date).toLocaleDateString('en-GB', { 
                        day: '2-digit', month: 'short' 
                    });
                    
                    // Create info window for midpoint label
                    const midpointMarker = new google.maps.Marker({
                        position: midpoint,
                        map: dashboardMap,
                        icon: {
                            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                                '<svg xmlns="http://www.w3.org/2000/svg" width="100" height="30"><rect x="0" y="0" width="100" height="30" rx="15" fill="' + color + '"/><text x="50" y="20" text-anchor="middle" fill="white" font-size="11" font-weight="bold">📅 ' + deliveryDate + '</text></svg>'
                            ),
                            scaledSize: new google.maps.Size(100, 30),
                            anchorPoint: new google.maps.Point(50, 15)
                        },
                        title: 'Expected Delivery: ' + transport.delivery_date,
                        zIndex: 1000
                    });
                    
                    dashboardMarkers.push(midpointMarker);
                }
                
                // Add click listener to show route details
                const routeContentString = `
                    <div style="font-family: Arial, sans-serif; max-width: 280px; padding: 12px;">
                        <h4 style="margin: 0 0 10px 0; color: ${color}; border-bottom: 2px solid ${color}; padding-bottom: 8px;">
                            🛣️ Trip Route
                        </h4>
                        <p style="margin: 6px 0;"><strong>Order No:</strong> ${transport.order_no || transport.id}</p>
                        <p style="margin: 6px 0;"><strong>From:</strong> ${origin}</p>
                        <p style="margin: 6px 0;"><strong>To:</strong> ${destination}</p>
                        <p style="margin: 6px 0;"><strong>Distance:</strong> ${legs.distance.text}</p>
                        <p style="margin: 6px 0;"><strong>Duration:</strong> ${legs.duration.text}</p>
                        <p style="margin: 6px 0;"><strong>Vehicle:</strong> ${transport.assigned_vehicle_no || 'N/A'}</p>
                        <p style="margin: 6px 0;"><strong>Driver:</strong> ${transport.assigned_driver || 'N/A'}</p>
                        <p style="margin: 10px 0 0 0;"><a href="/admin/consignment/${transport.id}" style="color: #317ff1;">View Full Details →</a></p>
                    </div>
                `;
                
                google.maps.event.addListener(routePolyline, 'click', function(event) {
                    dashboardInfoWindow.setContent(routeContentString);
                    dashboardInfoWindow.setPosition(event.latLng);
                    dashboardInfoWindow.open(dashboardMap);
                });
            } else {
                console.log('Directions request failed for ' + origin + ' to ' + destination + ': ' + status);
                // Draw straight line as fallback
                drawStraightLineRoute(origin, destination, transport, color);
            }
        });
    }

    // Draw straight line route as fallback
    function drawStraightLineRoute(origin, destination, transport, color) {
        const geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({ address: origin }, function(results1, status1) {
            let lat1 = 25.2048, lng1 = 55.2708;
            if (status1 === 'OK' && results1[0]) {
                lat1 = results1[0].geometry.location.lat();
                lng1 = results1[0].geometry.location.lng();
            }
            
            geocoder.geocode({ address: destination }, function(results2, status2) {
                let lat2 = 24.4539, lng2 = 54.3773;
                if (status2 === 'OK' && results2[0]) {
                    lat2 = results2[0].geometry.location.lat();
                    lng2 = results2[0].geometry.location.lng();
                }
                
                const straightLine = new google.maps.Polyline({
                    path: [
                        { lat: lat1, lng: lng1 },
                        { lat: lat2, lng: lng2 }
                    ],
                    geodesic: true,
                    strokeColor: color,
                    strokeWeight: 4,
                    strokeOpacity: 0.8,
                    map: dashboardMap
                });
                
                dashboardPolylines.push(straightLine);
            });
        });
    }

    // Add vehicle markers (fallback when no ongoing transports)
    function addVehicleMarkers() {
        const vehicles = [
            { lat: 25.2048, lng: 55.2708, status: 'running', name: 'Truck DXB-001', number: 'DXB-1234' },
            { lat: 24.4539, lng: 54.3773, status: 'running', name: 'Truck AUH-002', number: 'AUH-5678' },
            { lat: 25.2854, lng: 55.3692, status: 'running', name: 'Truck SHR-003', number: 'SHR-9012' },
            { lat: 21.4858, lng: 39.1925, status: 'running', name: 'Truck JED-004', number: 'JED-3456' },
            { lat: 24.7136, lng: 46.6753, status: 'running', name: 'Truck RYD-005', number: 'RYD-7890' }
        ];
        
        vehicles.forEach(vehicle => {
            const icon = {
                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#4CAF50" stroke="white" stroke-width="2"/><path d="M8 12h8M12 8v8" stroke="white" stroke-width="2"/></svg>'),
                scaledSize: new google.maps.Size(32, 32),
                anchorPoint: new google.maps.Point(16, 16)
            };
            
            const marker = new google.maps.Marker({
                position: { lat: vehicle.lat, lng: vehicle.lng },
                map: dashboardMap,
                icon: icon,
                title: vehicle.name,
                animation: google.maps.Animation.DROP
            });
            
            dashboardMarkers.push(marker);
            
            const contentString = `
                <div style="font-family: Arial, sans-serif; max-width: 220px; padding: 10px;">
                    <h4 style="margin: 0 0 10px 0; color: #004271; border-bottom: 2px solid #004271; padding-bottom: 5px;">${vehicle.name}</h4>
                    <p style="margin: 5px 0;"><strong>Status:</strong> <span style="color: #4CAF50">🟢 Running</span></p>
                    <p style="margin: 5px 0;"><strong>Vehicle No:</strong> ${vehicle.number}</p>
                    <p style="margin: 5px 0;"><strong>Location:</strong> ${vehicle.lat.toFixed(4)}, ${vehicle.lng.toFixed(4)}</p>
                    <p style="margin: 5px 0;"><strong>Last Update:</strong> ${new Date().toLocaleString()}</p>
                </div>
            `;
            
            marker.addListener('click', () => {
                dashboardInfoWindow.setContent(contentString);
                dashboardInfoWindow.open(dashboardMap, marker);
            });
        });
    }

    // Add points of interest (cities, industrial areas)
    function addPointsOfInterest() {
        const pointsOfInterest = [
            // UAE Major Cities
            { lat: 25.2048, lng: 55.2708, name: 'Dubai', type: 'city' },
            { lat: 24.4539, lng: 54.3773, name: 'Abu Dhabi', type: 'city' },
            { lat: 25.2854, lng: 55.3692, name: 'Sharjah', type: 'city' },
            { lat: 25.5828, lng: 55.6472, name: 'Ajman', type: 'city' },
            { lat: 25.7895, lng: 55.9432, name: 'Ras Al Khaimah', type: 'city' },
            // Saudi Arabia Major Cities
            { lat: 24.7136, lng: 46.6753, name: 'Riyadh', type: 'city' },
            { lat: 21.4858, lng: 39.1925, name: 'Jeddah', type: 'city' },
            { lat: 26.4200, lng: 50.1000, name: 'Dammam', type: 'city' },
            // Qatar Major Cities
            { lat: 25.3548, lng: 51.1839, name: 'Doha', type: 'city' },
            // Bahrain Major Cities
            { lat: 26.0667, lng: 50.5577, name: 'Manama', type: 'city' },
            // Industrial Areas
            { lat: 24.9800, lng: 55.0500, name: 'Jebel Ali Free Zone', type: 'industrial' }
        ];
        
        pointsOfInterest.forEach(point => {
            let iconColor, iconSymbol;
            switch(point.type) {
                case 'city':
                    iconColor = '#9C27B0';
                    iconSymbol = '🏙';
                    break;
                case 'industrial':
                    iconColor = '#607D8B';
                    iconSymbol = '🏭';
                    break;
                default:
                    iconColor = '#607D8B';
                    iconSymbol = '📍';
            }
            
            const marker = new google.maps.Marker({
                position: { lat: point.lat, lng: point.lng },
                map: dashboardMap,
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="' + iconColor + '" stroke="white" stroke-width="1"/><text x="12" y="16" text-anchor="middle" fill="white" font-size="12">' + iconSymbol + '</text></svg>'),
                    scaledSize: new google.maps.Size(24, 24),
                    anchorPoint: new google.maps.Point(12, 12)
                },
                title: point.name
            });
            
            dashboardMarkers.push(marker);
            
            const typeLabel = point.type.charAt(0).toUpperCase() + point.type.slice(1);
            
            const contentString = `
                <div style="font-family: Arial, sans-serif; max-width: 200px; padding: 10px;">
                    <h4 style="margin: 0 0 8px 0; color: #333;">${point.name}</h4>
                    <p style="margin: 4px 0;"><strong>Type:</strong> ${typeLabel}</p>
                </div>
            `;
            
            marker.addListener('click', () => {
                dashboardInfoWindow.setContent(contentString);
                dashboardInfoWindow.open(dashboardMap, marker);
            });
        });
    }

    // Fit map to show all markers
    function fitMapToMarkers() {
        if (dashboardMarkers.length === 0) return;
        
        const bounds = new google.maps.LatLngBounds();
        dashboardMarkers.forEach(marker => {
            bounds.extend(marker.getPosition());
        });
        
        dashboardMap.fitBounds(bounds, 50);
    }

    // Change map type
    function changeDashboardMapType(mapType) {
        if (!dashboardMap) return;
        
        const mapTypes = {
            'roadmap': google.maps.MapTypeId.ROADMAP,
            'satellite': google.maps.MapTypeId.SATELLITE,
            'terrain': google.maps.MapTypeId.TERRAIN,
            'hybrid': google.maps.MapTypeId.HYBRID
        };
        
        dashboardMap.setMapTypeId(mapTypes[mapType]);
        
        document.querySelectorAll('.map-type-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector('[data-map-type="' + mapType + '"]').classList.add('active');
    }

    // Sidebar toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Google Maps after a short delay
        setTimeout(function() {
            initDashboardMap();
        }, 1000);

        // Vehicle status card click handlers
        const statusCards = document.querySelectorAll('.status-card');
        statusCards.forEach(card => {
            card.addEventListener('click', function() {
                const status = this.classList.contains('all') ? 'all' :
                              this.classList.contains('running') ? 'running' :
                              this.classList.contains('halt') ? 'halt' :
                              this.classList.contains('idle') ? 'idle' :
                              this.classList.contains('inactive') ? 'inactive' : 'nodata';

                console.log('Filtering vehicles by status: ' + status);
            });
        });
    });
</script>

@endsection
