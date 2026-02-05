@extends('admin.layout.master')

@section('content')
<style>
    /* Dashboard Specific Styles */
    .dashboard-wrapper {
        margin-left: 70px;
        padding: 0;
        background: #e5eaf2;
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
        padding: 10px 20px 10px 45px;
        border: 1px solid #6c6c6c;
        border-radius: 30px;
        font-size: 18px;
        color: #666262;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #004271;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .task-dropdown {
        padding: 11px;
        border: 1px solid #6c6c6c;
        border-radius: 10px;
        background: white;
        cursor: pointer;
        font-size: 16px;
        color: black;
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
        background: #003b67;
        color: white;
        padding: 13px 46px;
        border-radius: 10px;
        border: none;
        font-weight: 500;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-main-account:hover {
        background: #002a4f;
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

    /* New Consignment Page Styles */
    .consignment-container {
        padding: 50px 40px;
    }

    .consignment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .consignment-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    /* Tab Navigation Container */
    .consignment-tabs {
        position: relative;
        height: 63px;
        margin-bottom: 2rem;
    }

    .tab-line {
        position: absolute;
        top: 29px;
        height: 3px;
        background: #000;
    }

    .tab-text {
        position: absolute;
        top: 31.5px;
        font-size: 19px;
        color: #6c6c6c;
        font-weight: 500;
        cursor: pointer;
        transform: translate(-50%, -50%);
        font-family: 'IBM Plex Sans', sans-serif;
        height: 45px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        width: 133px;
        line-height: normal;
    }

    .tab-text.active {
        color: #317ff1;
        font-weight: 600;
        font-size: 21px;
    }

    /* Form Steps */
    .form-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        gap: 0;
    }

    .step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 133px;
        height: 45px;
    }

    .step-label {
        font-size: 19px;
        font-weight: 500;
        color: #6c6c6c;
        text-align: center;
    }

    .step.active .step-label {
        font-size: 21px;
        font-weight: 600;
        color: #317ff1;
    }

    .step-line {
        width: 120px;
        height: 2px;
        background-color: #6c6c6c;
    }

    /* Base Styles */
    .consignment-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        width: 520px;
        height: 650px;
        margin: 1rem auto;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    /* Header Section */
    .consignment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .consignment-title {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    .consignment-title-icon {
        width: 40px;
        height: 40px;
        background: #FFD700;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
    }

    .consignment-subtitle {
        background: #FFF3CD;
        color: #856404;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .consignment-subtitle i {
        margin-right: 0.5rem;
        color: #FFC107;
    }

    /* Illustration Section */
    .consignment-illustration {
        margin: 1.5rem 0;
        text-align: center;
    }

    .consignment-illustration img {
        max-width: 100%;
        height: auto;
    }

    /* Features List */
    .consignment-features {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0;
    }

    .consignment-feature {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        color: #495057;
    }

    .consignment-feature-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        flex-shrink: 0;
        margin-top: 0.1rem;
    }

    .consignment-feature.capacity .consignment-feature-icon {
        background: #FFF3CD;
    }

    .consignment-feature.pricing .consignment-feature-icon {
        background: #FFE0B2;
    }

    .consignment-feature.best-for .consignment-feature-icon {
        background: #FFE0B2;
    }

    .consignment-feature.handling .consignment-feature-icon {
        background: #E3F2FD;
    }

    /* FTL Specific Styles */
    .consignment-title-icon.ftl {
        background: #FF9800;
    }

    .consignment-card.ftl .consignment-feature.capacity .consignment-feature-icon {
        background: #FFE0B2;
    }

    .consignment-card.ftl .consignment-feature.transit .consignment-feature-icon {
        background: #FFF3CD;
    }

    .consignment-card.ftl .consignment-feature.security .consignment-feature-icon {
        background: #F8BBD9;
    }

    .consignment-card.ftl .consignment-feature.best-for .consignment-feature-icon {
        background: #C8E6C9;
    }

    .consignment-feature-icon i {
        font-size: 0.8rem;
        color: #2C3E50;
    }

    /* CTA Button */
    .consignment-cta {
        background: #1E88E5;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        width: 100%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .consignment-cta:hover {
        background: #1976D2;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 136, 229, 0.3);
    }

    .consignment-cta i {
        margin-right: 0.5rem;
    }

    .consignment-card.active {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .consignment-options {
        display: flex;
        gap: 50px;
        margin-bottom: 3rem;
    }

    .consignment-option {
        flex: 1;
        text-align: center;
        padding: 2rem;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .consignment-option.ltl {
        background: #E3F2FD;
    }

    .consignment-option.ftl {
        background: #FFF3E0;
    }

    .consignment-option.active {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .consignment-option.ltl.active {
        background: #BBDEFB;
    }

    .consignment-option.ftl.active {
        background: #FFE0B2;
    }

    .consignment-option-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .consignment-option.ltl .consignment-option-icon {
        color: #1976D2;
    }

    .consignment-option.ftl .consignment-option-icon {
        color: #FF9800;
    }

    .consignment-option-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .consignment-option-description {
        color: #666;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .consignment-option-features {
        text-align: left;
        margin-bottom: 1.5rem;
    }

    .consignment-option-feature {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .consignment-option-feature i {
        margin-right: 0.5rem;
        font-size: 0.8rem;
    }

    .consignment-option-feature.ltl i {
        color: #1976D2;
    }

    .consignment-option-feature.ftl i {
        color: #FF9800;
    }

    .consignment-option-btn {
        background: #2C3E50;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .consignment-option-btn:hover {
        background: #1a252f;
        transform: translateY(-2px);
    }

    .consignment-comparison {
        background: white;
        border: 1px solid #e6e9f5;
        border-radius: 50px;
        margin-top: 2rem;
        overflow: hidden;
    }

    .comparison-table {
        width: 100%;
        border-collapse: collapse;
    }

    .comparison-table th,
    .comparison-table td {
        padding: 20px 32px;
         text-align: center;
        border-bottom: 1px solid #e6e9f5;
        border-right: 1px solid #e6e9f5;
    }

    .comparison-table th {
        background: white;
        font-weight: 600;
        color: #252430;
        font-size: 35px;
        border-top: 3px solid #e6e9f5;
        border-bottom: 3px solid #e6e9f5;
    }

    .comparison-table td {
        font-size: 18px;
        color: #252430;
    }

    .comparison-table tr:first-child th {
        border-top: none;
    }

    .comparison-table tr:last-child td {
        border-bottom: none;
    }

    .comparison-feature {
        font-weight: 500;
        color: #2C3E50;
    }

    .ltl-value {
        color: #1976D2;
    }

    .ftl-value {
        color: #FF9800;
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

        .consignment-container {
            padding: 1rem;
        }

        .consignment-options {
            flex-direction: column;
            gap: 1rem;
        }

        .consignment-tabs {
            flex-wrap: wrap;
        }

        .consignment-tab {
            padding: 0.75rem 0.5rem;
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

        <div class="task-dropdown">
            Task <i class="fas fa-chevron-down"></i>
        </div>

        <div class="nav-actions">
            <button class="btn-main-account">Go To Main Account</button>
            <button class="icon-btn">
                <i class="fas fa-cog"></i>
            </button>
            <button class="icon-btn">
                <i class="fas fa-bell"></i>
            </button>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div> -->

    <div class="consignment-container">
    

        <div class="form-steps">
            <div class="step active">
                <span class="step-label">Route & Parties</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <span class="step-label">Freight & Assignment</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <span class="step-label">Charges & Advance</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <span class="step-label">Booking Confirmed</span>
            </div>
        </div>

        <div class="consignment-options">
            <div class="consignment-card ltl active" id="ltl-option">
                <!-- Header Section -->
                <div class="consignment-header">
                    <div class="consignment-title">
                        <div class="consignment-title-icon">
                            <i class="fas fa-truck-loading" style="color: #2C3E50;"></i>
                        </div>
                        Part Load (LTL)
                    </div>
                    <div class="consignment-subtitle">
                        <i class="fas fa-star"></i>
                        Cheaper, suitable for smaller consignments
                    </div>
                </div>

                <!-- Illustration Section -->
                <div class="consignment-illustration">
                    <img src="/images/Worker packing the goods.png" alt="Worker packing goods">
                </div>

                <!-- Features List -->
                <ul class="consignment-features">
                    <li class="consignment-feature capacity">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <span><strong>Capacity:</strong> < 6 Pallets or < 5,000 kg.</span>
                    </li>
                    <li class="consignment-feature pricing">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <span><strong>Pricing:</strong> Pay only for the space you occupy.</span>
                    </li>
                    <li class="consignment-feature best-for">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <span><strong>Best For:</strong> Durable goods, flexible delivery dates.</span>
                    </li>
                    <li class="consignment-feature handling">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <span><strong>Handling:</strong> Multiple stops & transfers (Hub-and-Spoke).</span>
                    </li>
                </ul>

                <!-- CTA Button -->
                <a href="{{ route('admin.new-consignment.create') }}" class="consignment-cta" style="text-decoration: none; display: inline-block; width: 100%; text-align: center;">
                    <i class="fas fa-calendar-plus"></i>
                    Book LTL Consignment
                </a>
            </div>

            <div class="consignment-card ftl" id="ftl-option">
                <!-- Header Section -->
                <div class="consignment-header">
                    <div class="consignment-title">
                        <div class="consignment-title-icon ftl">
                            <i class="fas fa-truck" style="color: #2C3E50;"></i>
                        </div>
                        Full Load (FTL)
                    </div>
                    <div class="consignment-subtitle">
                        <i class="fas fa-star"></i>
                        Faster delivery & dedicated vehicle
                    </div>
                </div>

                <!-- Illustration Section -->
                <div class="consignment-illustration">
                    <img src="/images/Truck delivery service.png" alt="Truck delivery service">
                </div>

                <!-- Features List -->
                <ul class="consignment-features">
                    <li class="consignment-feature capacity">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <span><strong>Capacity:</strong> 10+ Pallets or > 5,000 kg.</span>
                    </li>
                    <li class="consignment-feature transit">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <span><strong>Transit:</strong> Fastest option (Direct Point-to-Point).</span>
                    </li>
                    <li class="consignment-feature security">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <span><strong>Security:</strong> Trailer sealed at pickup, opened at delivery.</span>
                    </li>
                    <li class="consignment-feature best-for">
                        <div class="consignment-feature-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <span><strong>Best For:</strong> High-value, fragile, or urgent bulk shipments.</span>
                    </li>
                </ul>

                <!-- CTA Button -->
                <a href="{{ route('admin.new-consignment.create') }}" class="consignment-cta" style="text-decoration: none; display: inline-block; width: 100%; text-align: center;">
                    <i class="fas fa-calendar-plus"></i>
                    Book FTL Consignment
                </a>
            </div>
        </div>

        <div class="consignment-comparison">
            <table class="comparison-table">
                <tr>
                    <th>Features</th>
                    <th>Part Load <span style="font-size: 14px; color: #858ba0;">(LTL)</span></th>
                    <th>Full Load <span style="font-size: 14px; color: #858ba0;">(FTL)</span></th>
                </tr>
                <tr>
                    <td>Cost Model</td>
                    <td>Weight Based - Per-Vehicle</td>
                    <td>Per - Vehicle</td>
                </tr>
                <tr>
                    <td>Delivery Speed</td>
                    <td>3-5 - 1-2 Days</td>
                    <td>1 - 2 Days</td>
                </tr>
                <tr>
                    <td>Consolidation</td>
                    <td>Yes</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Best for</td>
                    <td>Small Amounts</td>
                    <td>urgent / Large Amounts</td>
                </tr>
                <tr>
                    <td>Pricing</td>
                    <td>By Weight / Volume - Per-Vehicle</td>
                    <td>Per - Vehicle</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab navigation functionality
        const tabs = document.querySelectorAll('.tab-text');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');
            });
        });

        // LTL/FTL option selection
        const ltlOption = document.getElementById('ltl-option');
        const ftlOption = document.getElementById('ftl-option');

        ltlOption.addEventListener('click', function() {
            ltlOption.classList.add('active');
            ftlOption.classList.remove('active');
        });

        ftlOption.addEventListener('click', function() {
            ftlOption.classList.add('active');
            ltlOption.classList.remove('active');
        });
    });
</script>
@endsection