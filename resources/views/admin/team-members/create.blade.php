@extends('admin.layout.master')

@section('title', 'Add Team Member')

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

    .form-container-wrapper {
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

    /* Form Container */
    .form-container {
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

    .filter-icon {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 22px;
        color: #003B67;
    }

    /* Form Card */
    .member-form {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 20px;
        padding: 40px;
    }

    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .section-header i {
        font-size: 24px;
        color: #003B67;
    }

    .section-header h2 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px 40px;
        margin-bottom: 40px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 10px;
    }

    .required {
        color: #ED5A68;
    }

    .form-group input,
    .form-group select {
        height: 45px;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 0 17px;
        font-size: 14px;
        font-weight: 400;
        color: #000;
        background: #fff;
    }

    .form-group input::placeholder {
        color: #999;
    }

    /* Attach Documents Section */
    .attach-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #ddd;
    }

    .attach-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .attach-header i {
        font-size: 24px;
        color: #000;
    }

    .attach-header h3 {
        font-size: 20px;
        font-weight: 500;
        color: #000;
        margin: 0;
    }

    .file-upload-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 30px;
    }

    .file-upload-group {
        display: flex;
        flex-direction: column;
    }

    .file-upload-group label {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 10px;
    }

    .file-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .file-choose-btn {
        height: 40px;
        padding: 5px 20px;
        border: 1px solid #6C6C6C;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        color: #000;
        cursor: pointer;
        white-space: nowrap;
    }

    .file-input-wrapper input[type="file"] {
        display: none;
    }

    .file-name {
        font-size: 14px;
        color: #666;
    }

    /* Submit Button */
    .submit-section {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .btn-submit {
        height: 50px;
        padding: 0 50px;
        border-radius: 10px;
        border: none;
        background: #317FF1;
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: #2669cc;
    }
</style>

<div class="dashboard-wrapper">
<div class="form-container-wrapper">
   

    <!-- Form Container -->
    <div class="form-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-left">
                <a href="{{ route('admin.team-members.index') }}" class="back-btn">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h1>My Team</h1>
            </div>
            <button class="filter-icon">
                <i class="fas fa-filter"></i>
            </button>
        </div>

        <!-- Team Member Form -->
        <form class="member-form" method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Team Member Details Section -->
            <div class="section-header">
                <i class="fas fa-id-card"></i>
                <h2>Team Member Details</h2>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label><i class="fas fa-user" style="margin-right: 8px;"></i>Full Name<span class="required">*</span></label>
                    <input type="text" name="name" placeholder="e.g., John Doe" value="{{ old('name') }}" required>
                    @error('name')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-envelope" style="margin-right: 8px;"></i>Email<span class="required">*</span></label>
                    <input type="email" name="email" placeholder="e.g., john.doe@example.com" value="{{ old('email') }}" required>
                    @error('email')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-lock" style="margin-right: 8px;"></i>Password<span class="required">*</span></label>
                    <input type="password" name="password" placeholder="Enter password" required>
                    @error('password')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-phone" style="margin-right: 8px;"></i>Mobile<span class="required">*</span></label>
                    <input type="tel" name="mobile" placeholder="e.g., +1 234 567 8900" value="{{ old('mobile') }}" required>
                    @error('mobile')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-user-tag" style="margin-right: 8px;"></i>Role<span class="required">*</span></label>
                    <select name="role_id" required>
                        <option value="">Select Role</option>
                        @php
                            $roles = \App\Models\Role::where('is_active', true)->get();
                        @endphp
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-building" style="margin-right: 8px;"></i>Department</label>
                    <input type="text" name="department" placeholder="e.g., Operations" value="{{ old('department') }}">
                    @error('department')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-briefcase" style="margin-right: 8px;"></i>Position</label>
                    <input type="text" name="position" placeholder="e.g., Senior Manager" value="{{ old('position') }}">
                    @error('position')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-calendar-alt" style="margin-right: 8px;"></i>Date of Joining</label>
                    <input type="date" name="date_of_joining" value="{{ old('date_of_joining') }}">
                    @error('date_of_joining')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-toggle-on" style="margin-right: 8px;"></i>Status<span class="required">*</span></label>
                    <select name="status" required>
                        <option value="Active" {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Attach Profile Image Section -->
            <div class="attach-section">
                <div class="attach-header">
                    <i class="fas fa-paperclip"></i>
                    <h3>Attach Profile Image</h3>
                </div>

                <div class="file-upload-grid">
                    <div class="file-upload-group">
                        <label>Profile Picture</label>
                        <div class="file-input-wrapper">
                            <label for="profile-image" class="file-choose-btn">Choose File</label>
                            <input type="file" id="profile-image" name="profile_image" accept="image/*" onchange="updateFileName(this, 'profile-name')">
                            <span class="file-name" id="profile-name">No File Chosen</span>
                        </div>
                        <small style="color: #666; font-size: 12px;">Accepted formats: JPEG, PNG, JPG, GIF. Maximum size: 5MB</small>
                        @error('profile_image')
                            <span style="color: #ED5A68; font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="submit-section">
                <button type="submit" class="btn-submit">Save</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
function updateFileName(input, spanId) {
    const fileName = input.files[0] ? input.files[0].name : 'No File Chosen';
    document.getElementById(spanId).textContent = fileName;
}
</script>
@endsection