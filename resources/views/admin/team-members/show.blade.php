@extends('admin.layout.master')

@section('title', 'Team Member Details')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'IBM Plex Sans', sans-serif;
        background: #E5EAF2;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        margin-left: 70px;
        background: #E5EAF2;
    }

    .details-container-wrapper {
        width: 100%;
    }

    /* Top Navbar */
    .top-navbar {
        height: 60px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 40px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .search-container {
        position: relative;
        flex: 0 0 353px;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666262;
        font-size: 18px;
    }

    .search-input {
        width: 100%;
        height: 60px;
        border: none;
        border-radius: 30px;
        padding: 10px 20px 10px 55px;
        font-size: 18px;
        font-weight: 700;
        color: #666262;
        background: #fff;
    }

    .search-input::placeholder {
        color: #666262;
    }

    .task-dropdown {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 11px 0;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 11px 20px;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .btn-main-account {
        background: #003B67;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 13px 46px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    .icon-btn {
        width: 50px;
        height: 48px;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-btn i {
        font-size: 22px;
        color: #000;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .user-avatar i {
        font-size: 30px;
        color: #666;
    }

    /* Details Container */
    .details-container {
        padding: 50px 40px;
        width: 100%;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Page Header */
    .page-header {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 10px;
        padding: 18px 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .back-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: #003B67;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 15px;
    }

    .btn-edit, .btn-back {
        height: 45px;
        padding: 0 25px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-edit {
        background: #F4CE5B;
        color: #000;
    }

    .btn-edit:hover {
        background: #e6c84a;
    }

    .btn-back {
        background: #003B67;
        color: #fff;
    }

    .btn-back:hover {
        background: #002d52;
    }

    /* Profile Card */
    .profile-card {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 20px;
        padding: 40px;
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 40px;
    }

    /* Profile Image Section */
    .profile-image-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #003B67;
        margin-bottom: 20px;
    }

    .profile-name {
        font-size: 28px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 8px;
    }

    .profile-role {
        font-size: 18px;
        color: #666;
        margin-bottom: 15px;
    }

    .status-badges {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .status-badge {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-badge.active {
        background: #33C17F;
        color: #fff;
    }

    .status-badge.role {
        background: #317FF1;
        color: #fff;
    }

    /* Details Section */
    .details-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .info-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
    }

    .info-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #003B67;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-card h3 i {
        font-size: 20px;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 15px;
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-icon {
        width: 20px;
        font-size: 16px;
        color: #317FF1;
        margin-top: 2px;
    }

    .info-content h5 {
        font-size: 14px;
        font-weight: 500;
        color: #666;
        margin-bottom: 2px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-content p {
        font-size: 16px;
        color: #000;
        margin: 0;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-card {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .details-section {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .dashboard-wrapper {
            margin-left: 0;
        }

        .details-container {
            padding: 20px;
        }
    }
</style>

<div class="dashboard-wrapper">
<div class="details-container-wrapper">
   

    <!-- Details Container -->
    <div class="details-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <a href="{{ route('admin.team-members.index') }}" class="back-btn">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h1>Team Member Details</h1>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.team-members.edit', $teamMember->id) }}" class="btn-edit">
                    <i class="fas fa-pen"></i> Edit
                </a>
                <a href="{{ route('admin.team-members.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Profile Image Section -->
            <div class="profile-image-section">
                @if($teamMember->profile_image)
                    <img src="{{ asset($teamMember->profile_image) }}" alt="{{ $teamMember->name }}" class="profile-image">
                @else
                    <div class="profile-image" style="background: #003B67; display: flex; align-items: center; justify-content: center; color: white; font-size: 80px;">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
                <h2 class="profile-name">{{ $teamMember->name }}</h2>
                <p class="profile-role">{{ $teamMember->position ?: $teamMember->role_name }}</p>
                <div class="status-badges">
                    <span class="status-badge {{ strtolower($teamMember->status) }}">{{ $teamMember->status }}</span>
                    <span class="status-badge role">{{ $teamMember->role_name }}</span>
                </div>
            </div>

            <!-- Details Section -->
            <div class="details-section">
                <!-- Contact Information -->
                <div class="info-card">
                    <h3><i class="fas fa-address-book"></i> Contact Information</h3>

                    <div class="info-item">
                        <i class="fas fa-envelope info-icon"></i>
                        <div class="info-content">
                            <h5>Email</h5>
                            <p>{{ $teamMember->email }}</p>
                        </div>
                    </div>

                    @if($teamMember->mobile)
                    <div class="info-item">
                        <i class="fas fa-phone info-icon"></i>
                        <div class="info-content">
                            <h5>Mobile</h5>
                            <p>{{ $teamMember->mobile }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Employment Details -->
                <div class="info-card">
                    <h3><i class="fas fa-briefcase"></i> Employment Details</h3>

                    <div class="info-item">
                        <i class="fas fa-user-tag info-icon"></i>
                        <div class="info-content">
                            <h5>Role</h5>
                            <p>{{ $teamMember->role_name }}</p>
                        </div>
                    </div>

                    @if($teamMember->department)
                    <div class="info-item">
                        <i class="fas fa-building info-icon"></i>
                        <div class="info-content">
                            <h5>Department</h5>
                            <p>{{ $teamMember->department }}</p>
                        </div>
                    </div>
                    @endif

                    @if($teamMember->position)
                    <div class="info-item">
                        <i class="fas fa-briefcase info-icon"></i>
                        <div class="info-content">
                            <h5>Position</h5>
                            <p>{{ $teamMember->position }}</p>
                        </div>
                    </div>
                    @endif

                    @if($teamMember->date_of_joining)
                    <div class="info-item">
                        <i class="fas fa-calendar-alt info-icon"></i>
                        <div class="info-content">
                            <h5>Date of Joining</h5>
                            <p>{{ $teamMember->date_of_joining->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="info-item">
                        <i class="fas fa-toggle-on info-icon"></i>
                        <div class="info-content">
                            <h5>Status</h5>
                            <p><span class="status-badge {{ strtolower($teamMember->status) }}" style="display: inline-block; margin: 0;">{{ $teamMember->status }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection