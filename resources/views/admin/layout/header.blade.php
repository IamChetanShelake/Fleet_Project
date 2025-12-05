<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QWIKHOM CMS - Website Content Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        :root {
            --primary-color: #004271;
            --secondary-color: #353535;
            --dark-color: #000000;
            --light-bg: #e4f9ff;
            --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
            --border-radius: 15px;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-collapsed-width);
            background: linear-gradient(135deg, var(--secondary-color) 0%, #1a1a1a 100%);
            color: white;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .sidebar.expanded {
            width: var(--sidebar-width);
        }

        .sidebar.collapsed:hover {
            width: var(--sidebar-width);
        }

        .sidebar.collapsed:hover .nav-link {
            justify-content: flex-start;
            padding: 1rem 1.5rem;
            margin: 0 0.5rem;
        }

        .sidebar.collapsed:hover .nav-link i {
            margin-right: 12px;
            font-size: 1.3rem;
        }

        .sidebar.collapsed:hover .nav-text {
            opacity: 1;
            transform: translateX(0);
            position: static;
        }

        .sidebar.collapsed:hover .logo-text {
            opacity: 1;
            transform: translateY(0);
        }

        .sidebar.collapsed:hover .logo-container img {
            height: 80px;
            margin-bottom: 0.5rem;
        }

        .sidebar.collapsed:hover .toggle-text {
            opacity: 1;
        }

        .sidebar-header {
            padding: 2rem 1rem 1rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            transform: translateY(-10px);
        }

        .logo-container img {
            height: 40px;
            transition: all 0.3s ease;
            background: white;
            padding: 8px;
            border-radius: 12px;
            margin-bottom: 0.5rem;
        }

        .sidebar.collapsed .logo-container img {
            height: 35px;
            margin-bottom: 0;
        }

        .logo-text {
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .sidebar-nav {
            padding: 2rem 0 1rem 0;
            height: calc(100vh - 140px);
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Custom scrollbar styling for thicker scrollbar */
        .sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-toggle-btn {
            width: 100%;
            background: rgba(0, 66, 113, 0.1);
            border: 2px solid rgba(0, 66, 113, 0.3);
            color: white;
            padding: 0.75rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sidebar-toggle-btn:hover {
            background: rgba(0, 66, 113, 0.2);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .sidebar-toggle-btn i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .sidebar.expanded .sidebar-toggle-btn i {
            transform: rotate(180deg);
        }

        .toggle-text {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .toggle-text {
            opacity: 0;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
            padding: 1rem 1.5rem;
            margin: 0 0.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 1rem 0.5rem;
            margin: 0 0.25rem;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 66, 113, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background-color: rgba(0, 66, 113, 0.15);
            color: white !important;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 66, 113, 0.2);
        }

        .sidebar.collapsed .nav-link:hover {
            transform: none;
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color) 0%, #002d52 100%);
            color: white !important;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(0, 66, 113, 0.4);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link.active::before {
            display: none;
        }

        .nav-link i {
            font-size: 1.3rem;
            margin-right: 12px;
            width: 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.4rem;
        }

        .nav-text {
            transition: all 0.3s ease;
            white-space: nowrap;
            opacity: 1;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            transform: translateX(-10px);
            position: absolute;
            left: -9999px;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .dashboard-container {
            padding: 0;
        }

        .section-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: none;
            margin-bottom: 2rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #002d52 100%);
            color: white;
            border: none;
            padding: 1.5rem;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 2rem;
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #002d52 100%);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 66, 113, 0.3);
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 66, 113, 0.4);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .table thead th {
            background: var(--secondary-color);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 66, 113, 0.05);
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 66, 113, 0.25);
        }

        .rule-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-left: 5px solid var(--primary-color);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .rule-card:hover {
            transform: translateX(5px);
        }

        .rule-card h5 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .rule-card p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .stats-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card .icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stats-card h3 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-card p {
            color: #6c757d;
            font-weight: 500;
        }

        .calendar-container {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--card-shadow);
        }

        .calendar-header {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #5a595b 100%);
            color: white;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
            margin: -2rem -2rem 2rem -2rem;
        }

        /* Mobile and Tablet Responsive Styles */
        @media (max-width: 992px) {
            /* Hide sidebar by default on mobile/tablet */
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1050;
                width: var(--sidebar-width) !important;
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                background: linear-gradient(135deg, var(--secondary-color) 0%, #1a1a1a 100%);
            }

            /* Show sidebar when active */
            .sidebar.active {
                transform: translateX(0);
            }

            /* Adjust main content when sidebar is active */
            .main-content,
            .dashboard-wrapper {
                margin-left: 0 !important;
                transition: margin-left 0.3s ease;
            }

            /* Overlay when sidebar is open */
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .sidebar-overlay.active {
                opacity: 1;
                visibility: visible;
            }

            /* Mobile toggle button */
            .mobile-sidebar-toggle {
                position: fixed;
                top: 1rem;
                right: 1rem;
                z-index: 1060;
                background: var(--primary-color);
                color: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .mobile-sidebar-toggle:hover {
                background: #003159;
                transform: translateY(-2px);
            }

            /* Ensure proper sidebar styling on mobile */
            .sidebar-header {
                padding: 1.5rem;
                text-align: left;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .logo-container {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .logo-container img {
                height: 50px !important;
                margin-bottom: 0.5rem !important;
                background: white;
                padding: 8px;
                border-radius: 12px;
            }

            .logo-text {
                font-size: 1rem;
                font-weight: 600;
                color: white;
                opacity: 1 !important;
                transform: none !important;
            }

            .sidebar-nav {
                padding: 1rem 0;
                height: calc(100vh - 120px);
                overflow-y: auto;
            }

            .nav-item {
                margin-bottom: 0.25rem;
                padding: 0 0.5rem;
            }

            .nav-link {
                color: rgba(255, 255, 255, 0.8) !important;
                font-weight: 500;
                padding: 1rem 1.5rem;
                margin: 0 0.5rem;
                border-radius: 12px;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                text-decoration: none;
                justify-content: flex-start !important;
                width: calc(100% - 1rem) !important;
            }

            .nav-link:hover {
                background-color: rgba(0, 66, 113, 0.15);
                color: white !important;
                transform: none !important;
                box-shadow: none !important;
            }

            .nav-link.active {
                background: linear-gradient(135deg, var(--primary-color) 0%, #002d52 100%);
                color: white !important;
                font-weight: 600;
                box-shadow: 0 4px 20px rgba(0, 66, 113, 0.4);
            }

            .nav-link i {
                font-size: 1.3rem;
                margin-right: 12px !important;
                width: 24px;
                text-align: center;
            }

            .nav-text {
                opacity: 1 !important;
                transform: none !important;
                position: static !important;
                left: auto !important;
                white-space: nowrap;
            }

            /* Hide the expand/collapse button on mobile */
            .sidebar-footer {
                display: none;
            }

            /* Scrollbar styling for mobile sidebar */
            .sidebar-nav::-webkit-scrollbar {
                width: 5px;
            }

            .sidebar-nav::-webkit-scrollbar-thumb {
                background-color: rgba(255, 255, 255, 0.2);
                border-radius: 5px;
            }

            .sidebar-nav::-webkit-scrollbar-track {
                background-color: rgba(255, 255, 255, 0.1);
            }
        }

        /* Desktop styles (unchanged) */
        @media (min-width: 993px) {
            .mobile-sidebar-toggle {
                display: none;
            }

            .sidebar-overlay {
                display: none;
            }
        }

        /* iPad specific styles */
        @media (min-width: 768px) and (max-width: 992px) {
            .main-content,
            .dashboard-wrapper {
                margin-left: 70px !important;
            }

            .sidebar {
                transform: none !important;
                width: var(--sidebar-collapsed-width) !important;
            }

            .sidebar.active {
                width: var(--sidebar-width) !important;
            }
        }

        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
                margin-top: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .stats-card {
                margin-bottom: 1rem;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const dashboardWrapper = document.querySelector('.dashboard-wrapper');
            const toggleBtn = document.getElementById('sidebarToggle');
            const toggleIcon = toggleBtn ? toggleBtn.querySelector('i') : null;
            const toggleText = toggleBtn ? toggleBtn.querySelector('.toggle-text') : null;

            // Create mobile toggle button
            const mobileToggle = document.createElement('button');
            mobileToggle.className = 'mobile-sidebar-toggle';
            mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
            document.body.prepend(mobileToggle);

            // Create overlay
            const overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.prepend(overlay);

            // Mobile sidebar toggle
            mobileToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            // Close sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Close sidebar when clicking on a nav link (mobile)
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 992) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                });
            });

            // Desktop sidebar toggle functionality
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('expanded');
                    sidebar.classList.toggle('collapsed');

                    if (toggleIcon && toggleText) {
                        if (sidebar.classList.contains('expanded')) {
                            toggleIcon.classList.remove('fa-chevron-right');
                            toggleIcon.classList.add('fa-chevron-left');
                            toggleText.textContent = 'Collapse';
                        } else {
                            toggleIcon.classList.remove('fa-chevron-left');
                            toggleIcon.classList.add('fa-chevron-right');
                            toggleText.textContent = 'Expand';
                        }
                    }
                });
            }

            // Set initial state
            if (window.innerWidth > 992) {
                if (sidebar.classList.contains('collapsed') && mainContent) {
                    mainContent.style.marginLeft = '70px';
                }
                if (sidebar.classList.contains('collapsed') && dashboardWrapper) {
                    dashboardWrapper.style.marginLeft = '70px';
                }
            }

            // Add hover event listeners for desktop
            if (window.innerWidth > 992) {
                sidebar.addEventListener('mouseenter', function() {
                    if (sidebar.classList.contains('collapsed')) {
                        if (mainContent) mainContent.style.marginLeft = '280px';
                        if (dashboardWrapper) dashboardWrapper.style.marginLeft = '280px';
                    }
                });

                sidebar.addEventListener('mouseleave', function() {
                    if (sidebar.classList.contains('collapsed')) {
                        if (mainContent) mainContent.style.marginLeft = '70px';
                        if (dashboardWrapper) dashboardWrapper.style.marginLeft = '70px';
                    }
                });
            }

            // Get current URL path for active state
            const currentPath = window.location.pathname;

            // Remove active class from all nav links
            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to the matching nav link
            document.querySelectorAll('.nav-link').forEach(function(link) {
                const linkPath = link.getAttribute('href');
                if (linkPath && currentPath.includes(linkPath.split('/').pop())) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</head>
<body>
    <header>
        <!-- Sidebar -->
        <div class="sidebar collapsed" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="{{ asset('images/image 2 1.png') }}" alt="QWIKHOM Logo">
                <div class="logo-text">Peak Logistics</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.team-members.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Team Member</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.driving-team.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <span class="nav-text">Driving Team</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.billing-entities.index') }}">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span class="nav-text">Billing Entities</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.vehicle-monitoring.index') }}">
                        <i class="fas fa-truck"></i>
                        <span class="nav-text">Vehicle Monitoring</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.peak-accounts.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <span class="nav-text">Peak Accounts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.tyre-maintenance.index') }}">
                        <i class="fas fa-circle-notch"></i>
                        <span class="nav-text">Tyre Maintenance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.tyre-stock.index') }}">
                        <i class="fas fa-warehouse"></i>
                        <span class="nav-text">Tyre Stock</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.fleet-management.index') }}">
                        <i class="fas fa-bus"></i>
                        <span class="nav-text">Fleet Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.transport-management.index') }}">
                        <i class="fas fa-shipping-fast"></i>
                        <span class="nav-text">Transport Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.vehicle-maintenance.index') }}">
                        <i class="fas fa-tools"></i>
                        <span class="nav-text">Vehicle Maintenance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.expense-tracking.index') }}">
                        <i class="fas fa-calculator"></i>
                        <span class="nav-text">Expense Tracking</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.attendance-records.index') }}">
                        <i class="fas fa-calendar-check"></i>
                        <span class="nav-text">Attendance Records</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.geography.index') }}">
                        <i class="fas fa-map-marked-alt"></i>
                        <span class="nav-text">Geography</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.performance-reports.index') }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Performance Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admin-panel.index') }}">
                        <i class="fas fa-cog"></i>
                        <span class="nav-text">Admin Panel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.utilities-tools.index') }}">
                        <i class="fas fa-wrench"></i>
                        <span class="nav-text">Utilities & Tools</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.help-center.index') }}">
                        <i class="fas fa-question-circle"></i>
                        <span class="nav-text">Help Center</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.my-assistance.index') }}">
                        <i class="fas fa-headset"></i>
                        <span class="nav-text">My Assistance</span>
                    </a>
                </li>
                <li class="nav-item" style="padding-bottom: 70px;">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                               if(confirm('Are you sure you want to logout?')) {
                                   var form = document.createElement('form');
                                   form.method = 'POST';
                                   form.action = this.href;

                                   var csrfToken = document.createElement('input');
                                   csrfToken.type = 'hidden';
                                   csrfToken.name = '_token';
                                   csrfToken.value = '{{ csrf_token() }}';

                                   var methodField = document.createElement('input');
                                   methodField.type = 'hidden';
                                   methodField.name = '_method';
                                   methodField.value = 'POST';

                                   form.appendChild(csrfToken);
                                   form.appendChild(methodField);
                                   document.body.appendChild(form);
                                   form.submit();
                               }">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <button class="sidebar-toggle-btn" id="sidebarToggle">
                <i class="fas fa-chevron-right"></i>
                <span class="toggle-text">Expand</span>
            </button>
        </div>
    </div>
    </header>
