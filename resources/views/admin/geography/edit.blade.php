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

    /* Geography Edit Page Styles */
    .geography-container {
        padding: 50px 40px;
    }

    .geography-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .geography-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2C3E50;
    }

    /* Form Styles */
    .geography-form {
        background: white;
        border: 1px solid #6c6c6c;
        border-radius: 50px;
        padding: 24px 46px 40px;
        max-width: 1035px;
        margin: 0 auto;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px 60px;
        position: relative;
    }

    .form-grid::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: #e0e0e0;
        transform: translateX(-50%);
    }

    .form-section {
        padding: 0 20px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .section-icon {
        font-size: 28px;
    }

    .section-header h2 {
        font-size: 24px;
        font-weight: 500;
        color: black;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #313131;
        margin-bottom: 5px;
    }

    .required {
        color: #e31e24;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        height: 45px;
        border: 1px solid #313131;
        border-radius: 10px;
        padding: 0 17px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 300;
        font-size: 14px;
        color: #4c4c4c;
    }

    .form-group textarea {
        height: auto;
        resize: vertical;
        padding: 12px 17px;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #4c4c4c;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #317ff1;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        background: white;
    }

    .select-wrapper svg {
        position: absolute;
        right: 17px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding: 0 20px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary {
        background-color: rgba(0, 59, 103, 0.2);
        border: 1px solid #317ff1;
        color: black;
    }

    .btn-secondary:hover {
        background-color: rgba(0, 59, 103, 0.3);
    }

    .btn-primary {
        background-color: #317ff1;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1e5a99;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        max-width: 1035px;
        margin-left: auto;
        margin-right: auto;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .form-grid::before {
            display: none;
        }
    }

    @media (max-width: 767px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .geography-container {
            padding: 1rem;
        }

        .geography-form {
            border-radius: 20px;
            padding: 20px;
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

    <div class="geography-container">
        <div class="geography-header">
            <h1 class="geography-title">Edit Geography</h1>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="geography-form" method="POST" action="{{ route('admin.geography.update', $id) }}">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <div class="section-header">
                <span class="section-icon">📝</span>
                <h2>Edit Location Details</h2>
            </div>

            <div class="form-grid">
                <div class="form-section">
                    <div class="form-group">
                        <label>Location Name <span class="required">*</span></label>
                        <input type="text" name="location_name" placeholder="e.g., Main Warehouse" value="Main Warehouse" required>
                    </div>

                    <div class="form-group">
                        <label>Location Type <span class="required">*</span></label>
                        <div class="select-wrapper">
                            <select name="location_type" required>
                                <option value="">Select Type</option>
                                <option value="Warehouse" selected>Warehouse</option>
                                <option value="Office">Office</option>
                                <option value="Depot">Depot</option>
                                <option value="Terminal">Terminal</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Latitude <span class="required">*</span></label>
                        <input type="text" name="latitude" placeholder="e.g., 40.7128" value="40.7128" required>
                    </div>

                    <div class="form-group">
                        <label>Longitude <span class="required">*</span></label>
                        <input type="text" name="longitude" placeholder="e.g., -74.0060" value="-74.0060" required>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-group">
                        <label>Region <span class="required">*</span></label>
                        <div class="select-wrapper">
                            <select name="region" required>
                                <option value="">Select Region</option>
                                <option value="Northeast" selected>Northeast</option>
                                <option value="Southwest">Southwest</option>
                                <option value="Midwest">Midwest</option>
                                <option value="Southeast">Southeast</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status <span class="required">*</span></label>
                        <div class="select-wrapper">
                            <select name="status" required>
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Planned">Planned</option>
                            </select>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none"><path d="M1 1l4 4 4-4" stroke="#6C6C6C" stroke-width="1.5"/></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Capacity</label>
                        <input type="number" name="capacity" placeholder="e.g., 50000" value="50000" min="0">
                    </div>

                    <div class="form-group">
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" placeholder="Contact person name" value="John Smith">
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div class="section-header" style="margin-top: 40px;">
                <span class="section-icon">📍</span>
                <h2>Address Information</h2>
            </div>

            <div class="form-grid">
                <div class="form-section">
                    <div class="form-group">
                        <label>Full Address</label>
                        <textarea name="address" rows="4" placeholder="Complete address">123 Logistics Street, Warehouse District, New York, NY 10001</textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.geography.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Location</button>
            </div>
        </form>
    </div>
</div>
@endsection
